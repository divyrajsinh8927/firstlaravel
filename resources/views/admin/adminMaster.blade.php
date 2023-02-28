@include('admin.includes.sidebar')
<!-- sidebar menu area end -->
<!-- main content area start -->
@include('admin.includes.header')
<div class="main-content">
    <!-- header area start -->
    <!-- header area end -->
    @yield('admin')
    @include('admin.includes.footer')