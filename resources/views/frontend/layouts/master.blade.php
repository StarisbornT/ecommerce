<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>HumanResources &mdash; Free Business Website Template by Colorlib</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
</head>
<body>

  <div class="js-animsition animsition" id="site-wrap" data-animsition-in-class="fade-in" data-animsition-out-class="fade-out">


    @include('frontend.layouts.header')

   @yield('content')



@include('frontend.layouts.footer')


</div> <!-- .js-animsition -->

<script src="{{asset('frontend/js/scripts-all.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if ($errors->any())
                @foreach ($errors->all() as $error)
                   toastr.error("{{$error}}")
                @endforeach
            @endif
  </script>
@stack('scripts')

</body>
</html>
