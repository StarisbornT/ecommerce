@extends('vendor.layouts.master')
@section('title')
{{$setting->site_name}} || Create Product Variant
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
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Create Variant</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products-variant.store')}}" method="POST">
                    @csrf

                      <div class="form-group">
                          <input type="hidden" value="{{request()->product}}" name="product" class="form-control">
                      </div>

                      <div class="form-group mt-3">
                          <label for="">Name</label>
                          <input type="text" value="" name="name" class="form-control">
                      </div>

                      <div class="form-group mt-3">
                          <label for="">Status</label>
                          <select name="status" class="form-control" id="">
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                          </select>
                      </div>

                      <button type="submit" class="btn btn-primary mt-3">Create</button>
                  </form>
              </div>
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

