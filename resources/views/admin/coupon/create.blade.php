@extends('admin.layouts.master')

@section('content')


    <section class="section">
      <div class="section-header">
        <h1>Coupon</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h4>Create Coupon</h4>

              </div>
              <div class="card-body">

                <form action="{{route('admin.coupons.store')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" value="" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Code</label>
                    <input type="text" value="" name="code" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="text" value="" name="quantity" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Max Use Per Person</label>
                    <input type="text" value="" name="max_use" class="form-control">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="text" value="" name="start_date" class="form-control datepicker">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="text" value="" name="end_date" class="form-control datepicker">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Discount Type</label>
                            <select name="discount_type" class="form-control sub-category" id="">
                                <option value="percent">Percentage (%)</option>
                                <option value="amount">Amount ({{$setting->currency_icon}})</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Discount Value</label>
                            <input type="text" value="" name="discount_value" class="form-control">
                        </div>
                    </div>
                </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

              </div>

            </div>
          </div>

        </div>

      </div>
    </section>


@endsection

@push('scripts')


@endpush

