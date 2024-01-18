@extends('vendor.layouts.master')
@section('title')
{{$setting->site_name}} || Orders
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
            <h3><i class="far fa-user"></i>Orders</h3>

            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{$dataTable->table()}}
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

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}


@endpush
