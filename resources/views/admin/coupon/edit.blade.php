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
                <h4>Update Coupon</h4>

              </div>
              <div class="card-body">

                <form action="{{route('admin.coupons.update', $coupon->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" value="{{$coupon->name}}" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Code</label>
                    <input type="text" value="{{$coupon->code}}" name="code" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="text" value="{{$coupon->quantity}}" name="quantity" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Max Use Per Person</label>
                    <input type="text" value="{{$coupon->max_use}}" name="max_use" class="form-control">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="text" value="{{$coupon->start_date}}" name="start_date" class="form-control datepicker">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="text" value="{{$coupon->end_date}}" name="end_date" class="form-control datepicker">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Discount Type</label>
                            <select name="discount_type" class="form-control sub-category" id="">
                                <option {{$coupon->discount_type == 'percent' ? 'selected' : ''}} value="percent">Percentage (%)</option>
                                <option {{$coupon->discount_type == 'amount' ? 'selected' : ''}} value="amount">Amount ({{$setting->currency_icon}})</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Discount Value</label>
                            <input type="text" value="{{$coupon->discount_value}}" name="discount_value" class="form-control">
                        </div>
                    </div>
                </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{$coupon->status == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option {{$coupon->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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


@endpush

