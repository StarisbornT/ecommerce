@extends('admin.layouts.master')

@section('content')


    <section class="section">
      <div class="section-header">
        <h1>Sub Category</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h4>Edit Sub Category</h4>

              </div>
              <div class="card-body">

                <form action="{{route('admin.sub-category.update', $subcategory->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="">Category</label>
                    <select name="category" class="form-control" id="">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option {{$category->id == $subcategory->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="{{$subcategory->name}}" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{$subcategory->status == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option {{$subcategory->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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

