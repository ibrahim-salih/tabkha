<!DOCTYPE html>
<html class="loading" lang="ar" data-textdirection="rtl">
<head>
@include('layouts.dashboard.head')
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    @include('layouts.dashboard.header')
  
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  @include('layouts.dashboard.sidebar')
  @include('layouts.dashboard.flash_messages')
  @yield('content')
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  @include('layouts.dashboard.footer')

  @include('layouts.dashboard.scripts')
</body>
</html>