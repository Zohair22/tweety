<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Laravel') }}</title>

   <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}" defer></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js " defer></script>
   <!-- Fonts -->
   <link rel="dns-prefetch" href="//fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>


<div id="app">
   <nav class="navbar navbar-expand-md navbar-light bg-info text-white shadow-sm">
      <div class="container">
         <a class="navbar-brand display-5 font-weight-bolder text-white" href="{{ route('home') }}">
            <i class="fas fa-feather-alt text-white"></i>
            {{ config('app.name', 'Tweety') }}
         </a>
         @auth
         <div class="d-flex align-items-center ml-3">
            <a href="{{ auth()->user()->path() }}" class="d-flex flex-row align-items-center text-decoration-none text-white">
               <div>
                  <img src="{{ auth()->user()->avatar }}" class="rounded-circle mr-1" alt="" style="max-width: 30px; min-width: 30px;min-height: 30px;max-height: 30px">
               </div>
               <div>
                  <h4 class="text-md ml-1">{{ auth()->user()->username }}</h4>
               </div>
            </a>
         </div>
         @endauth
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
               <!-- Authentication Links -->
               @guest
                  @if (Route::has('login'))
                     <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                     </li>
                  @endif

                  @if (Route::has('register'))
                     <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                     </li>
                  @endif
               @else
                  <li class="nav-item dropdown">
                     <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                     </a>

                     <div class="dropdown-menu dropdown-menu-right bg-info" aria-labelledby="navbarDropdown">
                        <a href="{{ auth()->user()->path() }}" class="dropdown-item" >Profile</a>
                        <a href="{{ route('explore') }}" class="dropdown-item " >Explore</a>
                        <a class="dropdown-item " href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                           {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                        </form>
                     </div>
                  </li>
               @endguest
            </ul>
         </div>
      </div>
   </nav>

    {{ $slot }}
</div>

@include('components.aj')




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   @yield('scripts')
<script>
   $(document).ready(function(){
      $('#upload-cover').change(function() {
         $(this).parents().submit();
      });
      $('#upload-avatar').change(function() {
         $(this).parents().submit();
      });

   });
   function readURL(input) {
      if (input.files && input.files[0]) {
         FileReader().onload = function (e) {
            $('#G').show()
               .attr('src', e.target.result);
         };
      }
   }
</script>

</body>
</html>
