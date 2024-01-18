@extends('frontend.dashboard.layouts.master')
@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> profile</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>basic information</h4>


                    <div class="wsus__dash_pass_change mt-2">

                        <p>Name: {{$profile->name}}</p>
                        <p>Email: {{$profile->email}}</p>
                        <p>Phone Number: {{$profile->phone}}</p>
                        <p>Employee Role: {{$profile->employee_role}}</p>

                        <p>Status: {{$profile->status == 'active' ? "Hired" : 'Fired'}}</p>

                        {{-- <form action="{{route('user.profile.update.password')}}" method="POST">

                            <div class="row">
                        <h4>Update Password</h4>
                        <div class="col-xl-4 col-md-6">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-unlock-alt"></i>
                            <input type="password" placeholder="Current Password" name="current_password">
                          </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-lock-alt"></i>
                            <input type="password" placeholder="New Password" name="password">
                          </div>
                        </div>
                        <div class="col-xl-4">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-lock-alt"></i>
                            <input type="password" placeholder="Confirm Password" name="password_confirmation">
                          </div>
                        </div>
                        <div class="col-xl-12">
                          <button class="common_btn" type="submit">Update</button>
                        </div>
                      </div>
                    </form> --}}
                    </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->

@endsection
