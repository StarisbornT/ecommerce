@extends('vendor.layouts.master')
@section('title')
{{$setting->site_name}} || Image Gallery
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
            <a href="{{route('vendor.products.index')}}" class="btn btn-warning mb-4"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fa fa-picture-o" aria-hidden="true"></i>Product: {{$product->name}}</h3>

            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products-image-gallery.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                     <div class="form-group ">
                         <label for="">Image <code>{Multiple Image Supported}</code></label>
                         <input type="file" class="form-control mt-3" multiple name="image[]">
                         <input type="hidden" value="{{$product->id}}" name="product">
                     </div>
                     <button type="submit" class="btn btn-primary mt-3">Upload</button>
                 </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fa fa-picture-o" aria-hidden="true"></i>Products Images</h3>

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
