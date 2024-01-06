<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Add to cart
        $('.shopping-cart-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'POST',
                data: formData,
                url: "{{route('add-to-cart')}}",
                success: function(data) {
                    if(data.status == 'success') {
                        getCartCount();
                        fetchSidebarCartProducts();
                        $('.mini_cart_action').removeClass('d-none');
                        toastr.success(data.message);
                    } else if(data.status == 'error') {
                        toastr.error(data.message);
                    }
                },
                error: function(data) {

                }
            })
        })

        function getCartCount() {
            $.ajax({
                method: 'GET',
                url: "{{route('cart-count')}}",
                success: function(data) {
                    $('#cart-count').text(data);
                },
                error: function(data) {

                }
            })
        }
        function fetchSidebarCartProducts() {
                $.ajax({
                method: 'GET',
                url: "{{route('cart-products')}}",
                success: function(data) {
                   console.log(data);
                   $('.mini_cart_wrapper').html("");
                   var html = ''
                   for(let item in data){
                    let product = data[item];
                        html += `
                        <li id="mini_cart_${product.rowId}">
                            <div class="wsus__cart_img">
                                <a href="#"><img src="{{asset('/')}}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                                <a class="wsis__del_icon remove_sidebar_product" data-id="${product.rowId}"><i class="fas fa-minus-circle"></i></a>
                            </div>
                            <div class="wsus__cart_text">
                                <a class="wsus__cart_title" href="{{url('product-detail')}}/${product.options.slug}">${product.name}</a>
                                <p>{{$setting->currency_icon}}${product.price}</p>
                                <small>Variant total: {{$setting->currency_icon}}${product.options.variants_total}</small> <br>
                                <small>Quantity: ${product.qty}</small>
                            </div>
                        </li>
                    `
                   }
                   $('.mini_cart_wrapper').html(html);
                   getSidebarCartSubtotal();
                },
                error: function(data) {

                }
            })
            }
            // Remove product from sidebar
            $('body').on('click', '.remove_sidebar_product', function(e) {
                e.preventDefault();
                let rowId = $(this).data('id');
                $.ajax({
                method: 'POST',
                data: {
                    rowId: rowId
                },
                url: "{{route('cart.remove-sidebar-product')}}",
                success: function(data) {
                    let productId = '#mini_cart_'+rowId;
                    $(productId).remove();
                    getSidebarCartSubtotal();
                    if($('.mini_cart_wrapper').find('li').length === 0) {
                        $('.mini_cart_action').addClass('d-none');
                        $('.mini_cart_wrapper').html('<li class="text-center">Cart is Empty</li>')
                    }
                    toastr.success(data.message)
                },
                error: function(data) {
                    console.log(data)
                }
            })
            })

            // get sidebar cart subtotal
            function getSidebarCartSubtotal() {
                $.ajax({
                method: 'GET',
                url: "{{route('cart.sidebar-product-total')}}",
                success: function(data) {
                    $('#mini_cart_subtotal').text("{{$setting->currency_icon}}"+data);
                },
                error: function(data) {

                }
            })
            }

            // get total cart amount
            function getTotalCartAmount() {
                $.ajax({
                method: 'GET',
                url: "{{route('cart.sidebar-product-total')}}",
                success: function(data) {
                    return data;
                },
                error: function(data) {

                }
            })
            }
    })
</script>