@extends('admin.layouts.master')

@section('content')


    <section class="section">
      <div class="section-header">
        <h1>Products</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h4>Update Product</h4>

              </div>
              <div class="card-body">
                <form action="{{route('admin.products.update', $products->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Label Preview</label> <br>
                        <img src="{{asset($products->thumb_image)}}" width="200px" alt="">
                    </div>

                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="{{$products->name}}" name="name" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="category" class="form-control main-category" id="">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option {{$category->id == $products->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sub_category">Sub Category</label>
                                <select name="sub_category" class="form-control sub-category" id="sub_category">
                                    <option value="">Select</option> <!-- Empty value option -->
                                    @foreach ($subCategories as $subCategory)
                                        <option {{ $subCategory->id == $products->sub_category_id ? 'selected' : '' }} value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Child Category</label>
                                <select name="child_category" class="form-control child-category" id="">
                                    <option value="">Select</option>
                                    @foreach ($childCategories as $childCategory)
                                        <option {{$childCategory->id == $products->child_category_id ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="">Brand</label>
                        <select name="brand" class="form-control" id="">
                            <option>Select</option>
                            @foreach ($brands as $brand)
                            <option {{$brand->id == $products->brand_id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name}}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">SkU</label>
                        <input type="text" value="{{$products->sku}}" name="sku" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" value="{{$products->price}}" name="price" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Offer Price</label>
                        <input type="text" value="{{$products->offer_price}}" name="offer_price" class="form-control">
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Offer Start Date</label>
                                <input type="text" value="{{$products->offer_start_date}}" name="offer_start_date" class="form-control datepicker">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Offer End Date</label>
                                <input type="text" value="{{$products->offer_end_date}}" name="offer_end_date" class="form-control datepicker">
                            </div>
                        </div>
                    </div>


                        <div class="form-group">
                            <label for="">Stock Quantity</label>
                            <input type="number" min="0" value="{{$products->qty}}" name="qty" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Video Link</label>
                            <input type="text" value="{{$products->video_link}}" name="video_link" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Short Description</label>
                            <textarea name="short_description" class="form-control">{!! $products->short_description !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Long Description</label>
                            <textarea name="long_description" class="form-control summernote">{!! $products->long_description !!}</textarea>
                        </div>


                                <div class="form-group">
                                    <label for="">Product Type</label>
                                    <select name="product_type" class="form-control" id="">
                                        <option value="">Select</option>
                                        <option {{$products->product_type == 'new_arrival' ? 'selected' : ''}} value="new_arrival">New Arrival</option>
                                        <option {{$products->product_type == 'featured_product' ? 'selected' : ''}} value="featured_product">Featured</option>
                                        <option {{$products->product_type == 'top_product' ? 'selected' : ''}} value="top_product">Top Product</option>
                                        <option {{$products->product_type == 'best_product' ? 'selected' : ''}} value="best_product">Best Product</option>
                                    </select>
                                </div>

                        <div class="form-group">
                            <label for="">SEO Title</label>
                            <input type="text" value="{{$products->seo_title}}" name="seo_title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">SEO Description</label>
                            <textarea name="seo_description" class="form-control">{!! $products->seo_description !!}</textarea>
                        </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{$products->status == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option {{$products->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>


@endsection



@push('scripts')
<script>
    $(document).ready(function() {
        $('body').on('change', '.main-category', function(e) {
            $('.child-category').html('<option value="">Select</option>')
            let id = $(this).val();
            $.ajax({
                method: 'GET',
                url: "{{route('admin.product.get-subcategories')}}",
                data: {
                    id:id
                },
                success: function(data) {
                    console.log(data)
                    $('.sub-category').html('<option value="">Select</option>')
                    $.each(data, function(i, item){
                        $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                    })
                },
                error: function(xhr, status, error) {
                    console.log("Error", error)
                }
            })
        })

        // Get child categories

        $('body').on('change', '.sub-category', function(e) {
            let id = $(this).val();
            $.ajax({
                method: 'GET',
                url: "{{route('admin.product.get-childcategories')}}",
                data: {
                    id:id
                },
                success: function(data) {
                    console.log(data)
                    $('.child-category').html('<option value="">Select</option>')
                    $.each(data, function(i, item){
                        $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                    })
                },
                error: function(xhr, status, error) {
                    console.log("Error", error)
                }
            })
        })
    })
</script>

@endpush
