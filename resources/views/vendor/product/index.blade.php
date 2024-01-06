@extends('vendor.layouts.master')
@section('title')
{{$setting->site_name}} || Products
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
            <h3><i class="far fa-user"></i>Products</h3>
            <div style="text-align: right; margin-bottom: 2%;">
                <a href="{{route('vendor.products.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Create Products</a>
            </div>
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

<script>

    $(document).ready(function() {
        $('body').on('click', '.change-status', function() {
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');

            $.ajax({
                url: "{{route('vendor.product.change-status')}}",
                method: 'PUT',
                data : {
                    status: isChecked,
                    id: id
                },
                success: function(data) {
                    toastr.success(data.message)
                },
                error: function(xhr, status, error) {
                    console.log(error)
                }
        })
        })
    })

</script>
@endpush
