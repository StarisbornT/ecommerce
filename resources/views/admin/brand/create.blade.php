@extends('admin.layouts.master')

@section('content')


    <section class="section">
      <div class="section-header">
        <h1>Brand</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h4>Create Brand</h4>

              </div>
              <div class="card-body">
                <form action="{{route('admin.brand.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label for="">Logo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="{{old('type')}}" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Is Featured</label>
                        <select name="is_featured" class="form-control" id="">
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

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>


@endsection
