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
                <h4>Update Variants Item</h4>

              </div>
              <div class="card-body">

                <form action="{{route('admin.products-variant-item.update', $variantItem->id)}}" method="POST">
                  @csrf
                  @method('PUT')

                    <div class="form-group">
                        <label for="">Variant Name</label>
                        <input type="text" value="{{$variantItem->productVariant->name}}" readonly name="variant_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Item Name</label>
                        <input type="text" value="{{$variantItem->name}}" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Price <code>(Set 0 or make it free)</code></label>
                        <input type="text" value="{{$variantItem->price}}" name="price" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Is Default</label>
                        <select name="is_default" class="form-control" id="">
                            <option value="">Select</option>
                            <option {{$variantItem->is_default == 1 ? 'selected' : ''}} value="1">Yes</option>
                            <option {{$variantItem->is_default == 0 ? 'selected' : ''}} value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{$variantItem->status == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option {{$variantItem->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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

