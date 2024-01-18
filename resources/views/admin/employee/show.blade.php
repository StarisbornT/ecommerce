@extends('admin.layouts.master')

@section('content')


    <section class="section">
      <div class="section-header">
        <h1>Employee Information</h1>

      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h4>Profile for {{$profile->name}}</h4>

              </div>
              <div class="card-body">
                <div class="form-group">
                    <img src="{{asset($profile->image)}}" width="200px" alt="">
                </div>
                <p>Name: {{$profile->name}}</p>
                <p>Email: {{$profile->email}}</p>
                <p>Phone Number: {{$profile->phone}}</p>
                <p>Employee Role: {{$profile->employee_role}}</p>
                <p>Status: {{$profile->status == 'active' ? "Hired" : 'Fired'}}</p>
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>


@endsection

