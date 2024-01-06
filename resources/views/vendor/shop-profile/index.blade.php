@extends('vendor.layouts.master')
@section('title')
{{$setting->site_name}} || Shop Profile
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
            <h3><i class="far fa-user"></i>Shop profile</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.shop-profile.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-3 mb-3 wsus__input">
                        <label for="">Preview</label> <br>
                        <img width="200px" src="{{asset($profile->banner)}}" alt="">
                    </div>

                    <div class="form-group mt-3 mb-3 wsus__input">
                        <label for="">Banner</label>
                        <input type="file" name="banner" class="form-control">
                    </div>
                    <div class="form-group mt-3 mb-3 wsus__input">
                        <label for="">Shop Name</label>
                        <input type="text" value="{{$profile->shop_name}}" name="shop_name" class="form-control">
                    </div>

                    <div class="form-group mt-3 mb-3 wsus__input">
                        <label for="">Phone</label>
                        <input type="text" value="{{$profile->phone}}" name="phone" class="form-control">
                    </div>

                    <div class="form-group mt-3 mb-3 wsus__input">
                        <label for="">Email</label>
                        <input type="text" name="email" value="{{$profile->email}}" class="form-control">
                    </div>

                    <div class="form-group mt-3 mb-3 wsus__input">
                        <label for="">Address</label>
                        <input type="text" value="{{$profile->address}}" name="address" class="form-control">
                    </div>
                    <div class="wsus__input form-group  mt-3 mb-3 ">
                        <label for="">Description</label>
                        <textarea class="summernote" name="description">{{$profile->description}}</textarea>
                        {{-- <input type="text" name="description" value="{{old('description')}}" class="form-control"> --}}
                    </div>
                    <div class="form-group mt-3 mb-3 wsus__input">
                        <label for="">Facebook Link</label>
                        <input type="text" name="fb_link" value="{{$profile->fb_link}}" class="form-control">
                    </div>
                    <div class="form-group mt-3 mb-3 wsus__input">
                        <label for="">Twitter Link</label>
                        <input type="text" name="tw_link" value="{{$profile->tw_link}}" class="form-control">
                    </div>
                    <div class="form-group mt-3 mb-3 wsus__input">
                        <label for="">Instagram Link</label>
                        <input type="text" name="insta_link" value="{{$profile->insta_link}}" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
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
