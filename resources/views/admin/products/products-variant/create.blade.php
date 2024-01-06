@extends('admin.layouts.master')

@section('content')


    <section class="section">
      <div class="section-header">
        <h1>Product Variant</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h4>Create Variants</h4>

              </div>
              <div class="card-body">

                <form action="{{route('admin.products-variant.store')}}" method="POST">
                  @csrf

                    <div class="form-group">
                        <input type="hidden" value="{{request()->product}}" name="product" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

              </div>

            </div>
          </div>

        </div>

      </div>
    </section>


@endsection

