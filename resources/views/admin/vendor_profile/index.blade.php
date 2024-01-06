@extends('admin.layouts.master')

@section('content')


    <section class="section">
      <div class="section-header">
        <h1>Vendor Profile</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h4>Update Vendor Profile</h4>

              </div>
              <div class="card-body">
                <form action="{{route('admin.vendor-profile.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Preview</label> <br>
                        <img width="200px" src="{{asset($profile->banner)}}" alt="">
                    </div>

                    <div class="form-group">
                        <label for="">Banner</label>
                        <input type="file" name="banner" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Shop Name</label>
                        <input type="text" value="{{$profile->shop_name}}" name="shop_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" value="{{$profile->phone}}" name="phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" value="{{$profile->email}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" value="{{$profile->address}}" name="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="summernote" name="description">{{$profile->description}}</textarea>
                        {{-- <input type="text" name="description" value="{{old('description')}}" class="form-control"> --}}
                    </div>
                    <div class="form-group">
                        <label for="">Facebook Link</label>
                        <input type="text" name="fb_link" value="{{$profile->fb_link}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Twitter Link</label>
                        <input type="text" name="tw_link" value="{{$profile->tw_link}}" class="form-control">
                    </div>
                    <div class="form-group">
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
    </section>


@endsection
