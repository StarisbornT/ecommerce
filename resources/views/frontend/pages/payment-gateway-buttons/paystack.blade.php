<div class="tab-pane fade" id="v-pills-paystack" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
        <div class="row">
            <div class="col-xl-12 m-auto">
                <div class="wsus__payment_area">
                    <form id="paymentForm">

                        <div class="form-submit">
                          <button type="submit" class="nav-link common_btn" onclick="payWithPaystack()"> Pay With Pay Stack </button>
                        </div>
                      </form>


                </div>
            </div>
        </div>
    </div>
@php
    $paystackSetting = \App\Models\PaystackSetting::first();
@endphp
@push('scripts')
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);

    function payWithPaystack(e) {
        e.preventDefault();

        let handler = PaystackPop.setup({
        key: "{{$paystackSetting->client_id}}",
        email: "{{Auth::user()->email}}",
        amount: "{{getFinalPayableAmount() * 100}}",

    onClose: function(){
        alert('Window closed.');
    },
    callback: function(response){
        // let message = 'Payment complete! Reference: ' + response.reference;
        // alert(message);
        window.location.href="{{route('user.paystack.payment')}}" + response.redirecturl;
    }
    });

    handler.openIframe();
    }

</script>

@endpush
