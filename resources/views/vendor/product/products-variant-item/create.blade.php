@extends('vendor.layouts.master')
@section('title')
{{$setting->site_name}} || Create Product Variant Item
@endsection
<style>
    .wsus__input textarea{
    width: 100%;
    padding: 10px;
    border-radius: 3px;
    font-size: 16px;
    font-weight: 400;
    color: #353535;
    resize: none;
    border: 1px solid #eee;
}
</style>

@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <a href="{{route('vendor.products-variant-item.index', ['productId' => $product->id, 'variantId' => $variant->id])}}" class="btn btn-warning mb-4"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Create Variant Item</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products-variant-item.store')}}" method="POST">
                    @csrf

                      <div class="form-group">
                          <label for="">Variant Name</label>
                          <input type="text" value="{{$variant->name}}" readonly name="variant_name" class="form-control">
                      </div>

                      <div class="form-group">

                          <input type="hidden" value="{{$variant->id}}" name="variant_id" class="form-control">
                      </div>

                      <div class="form-group">

                          <input type="hidden" value="{{$product->id}}" name="product_id" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="">Item Name</label>
                          <input type="text" value="" name="name" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="">Price <code>(Set 0 or make it free)</code></label>
                          <input type="text" value="" name="price" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="">Is Default</label>
                          <select name="is_default" class="form-control" id="">
                              <option value="">Select</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                          </select>
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
  <!--=============================
    DASHBOARD START
  ==============================-->

@endsection

