@extends('admin.layouts.master')

@section('content')


    <section class="section">
      <div class="section-header">
        <h1>Product Variant Items</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h4>Create Variants Item</h4>

              </div>
              <div class="card-body">

                <form action="{{route('admin.products-variant-item.store')}}" method="POST">
                  @csrf

                    <div class="form-group">
                        <label for="">Variant Name</label>
                        <input type="text" value="{{$variant->name}}" readonly name="variant_name" class="form-control">
                    </div>

                    <div class="form-group">

                        <input type="hidden" value="{{$variant->id}}" name="variant_id" class="form-control">
                    </div>

                    <div class="form-group">

                        <input type="hidden" value="{{$product->id}}" name="product_id" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Item Name</label>
                        <input type="text" value="" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Price <code>(Set 0 or make it free)</code></label>
                        <input type="text" value="" name="price" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Is Default</label>
                        <select name="is_default" class="form-control" id="">
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

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

              </div>

            </div>
          </div>

        </div>

      </div>
    </section>


@endsection

