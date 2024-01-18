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
                <h4>Create Employee Profile</h4>

              </div>
              <div class="card-body">
                <form action="{{route('admin.employee.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="{{old('name')}}" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" value="{{old('username')}}" name="username" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="text" value="{{old('phone')}}" name="phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" value="{{old('email')}}" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" class="form-control" id="">
                            <option value="">Select</option>
                            <option value="manager">Manager</option>
                            <option value="developer">Developer</option>
                            <option value="design">Design</option>
                            <option value="scrum_master">Scrum Master</option>
                        </select>
                    </div>



                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" value="{{old('password')}}" name="password" class="form-control">
                        </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
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



@push('scripts')


@endpush
