<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="@if(Config::get('app.locale') == 'ar') rtl @else ltr @endif">
<head>
@include('layouts.cooker.head')
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    @include('layouts.cooker.header')
  
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  @include('layouts.cooker.sidebar')
  @include('layouts.cooker.flash_messages')
  @yield('content')
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  @include('layouts.cooker.footer')

  @include('layouts.cooker.scripts')
</body>
</html>