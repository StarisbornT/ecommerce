@extends('admin.layouts.master')

@section('content')


    <section class="section">
      <div class="section-header">
        <h1>Employee Profile</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h4>Update Employee Profile</h4>

              </div>
              <div class="card-body">
                <form action="{{route('admin.employee.update', $profile->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Label Preview</label> <br>
                        <img src="{{asset($profile->image)}}" width="200px" alt="">
                    </div>

                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="{{$profile->name}}" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" value="{{$profile->username}}" name="username" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="text" value="{{$profile->phone}}" name="phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" value="{{$profile->email}}" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" class="form-control" id="">
                            <option value="">Select</option>
                            <option {{$profile->employee_role == 'manager' ? 'selected' : ''}} value="manager">Manager</option>
                            <option {{$profile->employee_role == 'developer' ? 'selected' : ''}} value="developer">Developer</option>
                            <option {{$profile->employee_role == 'design' ? 'selected' : ''}} value="design">Design</option>
                            <option {{$profile->employee_role == 'scrum_master' ? 'selected' : ''}} value="scrum_master">Scrum Master</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{$profile->status == 'active' ? 'selected' : ''}} value="active">Active</option>
                            <option {{$profile->status == 'inactive' ? 'selected' : ''}} value="inactive">Inactive</option>
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



@push('scripts')
{{-- <script>
    $(document).ready(function() {
        $('body').on('change', '.main-category', function(e) {
            $('.child-category').html('<option value="">Select</option>')
            let id = $(this).val();
            $.ajax({
                method: 'GET',
                url: "{{route('admin.product.get-subcategories')}}",
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
                url: "{{route('admin.product.get-childcategories')}}",
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
</script> --}}

@endpush
