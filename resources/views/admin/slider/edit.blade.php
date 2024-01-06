@extends('admin.layouts.master')

@section('content')


    <section class="section">
      <div class="section-header">
        <h1>Slider</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h4>Edit Slider</h4>

              </div>
              <div class="card-body">
                <form action="{{route('admin.slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Preview</label> <br>
                        <img width="200px" src="{{asset($slider->banner)}}" alt="">
                    </div>

                    <div class="form-group">
                        <label for="">Banner</label>
                        <input type="file" name="banner" value="{{$slider->banner}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Type</label>
                        <input type="text" value="{{$slider->type}}" name="type" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" value="{{$slider->title}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Starting Price</label>
                        <input type="text" value="{{$slider->starting_price}}" name="starting_price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Button Url</label>
                        <input type="text" name="btn_url" value="{{$slider->btn_url}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Serial</label>
                        <input type="text" name="serial" value="{{$slider->serial}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{$slider->status == 1 ? 'selected': ''}} value="1">Active</option>
                            <option {{$slider->status == 0 ? 'selected': ''}} value="0">Inactive</option>
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
