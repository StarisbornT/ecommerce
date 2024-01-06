@extends('vendor.layouts.master')
@section('title')
{{$setting->site_name}} || Create Product
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
            <h3><i class="far fa-user"></i>Create Products</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="{{old('name')}}" name="name" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="category" class="form-control main-category" id="">
                                    <option>Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Sub Category</label>
                                <select name="sub_category" class="form-control sub-category" id="">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Child Category</label>
                                <select name="child_category" class="form-control child-category" id="">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="">Brand</label>
                        <select name="brand" class="form-control" id="">
                            <option>Select</option>
                            @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">SkU</label>
                        <input type="text" value="{{old('sku')}}" name="sku" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" value="{{old('price')}}" name="price" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Offer Price</label>
                        <input type="text" value="{{old('offer_price')}}" name="offer_price" class="form-control">
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Offer Start Date</label>
                                <input type="text" value="{{old('offer_start_date')}}" name="offer_start_date" class="form-control datepicker">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Offer End Date</label>
                                <input type="text" value="{{old('offer_end_date')}}" name="offer_end_date" class="form-control datepicker">
                            </div>
                        </div>
                    </div>


                        <div class="form-group">
                            <label for="">Stock Quantity</label>
                            <input type="number" min="0" value="{{old('qty')}}" name="qty" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Video Link</label>
                            <input type="text" value="{{old('video_link')}}" name="video_link" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Short Description</label>
                            <textarea name="short_description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Long Description</label>
                            <textarea name="long_description" class="form-control summernote"></textarea>
                        </div>


                                <div class="form-group">
                                    <label for="">Product Type</label>
                                    <select name="product_type" class="form-control" id="">
                                        <option value="">Select</option>
                                        <option value="new_arrival">New Arrival</option>
                                        <option value="featured_product">Featured</option>
                                        <option value="top_product">Top Product</option>
                                        <option value="best_product">Best Product</option>
                                    </select>
                                </div>

                        <div class="form-group">
                            <label for="">SEO Title</label>
                            <input type="text" value="{{old('seo_title')}}" name="seo_title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">SEO Description</label>
                            <textarea name="seo_description" class="form-control"></textarea>
                        </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
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

@push('scripts')

<script>
    $(document).ready(function() {
        $('body').on('change', '.main-category', function(e) {
            let id = $(this).val();
            $.ajax({
                method: 'GET',
                url: "{{route('vendor.product.get-subcategories')}}",
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
                url: "{{route('vendor.product.get-childcategories')}}",
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
