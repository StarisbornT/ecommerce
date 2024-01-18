@extends('frontend.layouts.master')

@section('content')
<div class="templateux-cover" style="background-image: url({{asset('frontend/images/slider-1.jpg')}});">
    <div class="container">
      <div class="row align-items-lg-center">

        <div class="col-lg-6 order-lg-1 text-center mx-auto">
          <h1 class="heading mb-3 text-white" data-aos="fade-up">Login</h1>

        </div>

      </div>
    </div>
  </div> <!-- .templateux-cover -->



  <div class="templateux-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-7 pr-md-7 mb-5">
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">Email</label>
              <input type="email" class="form-control" name="email" id="name">
            </div>
            <div class="form-group">
              <label for="email">Password</label>
              <input type="password" class="form-control" name="password" id="email">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary py-3 px-5" value="Login">
            </div>
          </form>
          <p>Dont Have an account <a href="{{route('register')}}">Signup</a></p>
        </div>

      </div> <!-- .row -->

    </div>
  </div> <!-- .templateux-section -->
@endsection
