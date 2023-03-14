@include('admin.includes.sidebar')
<!-- sidebar menu area end -->
<!-- main content area start -->
@include('admin.includes.header')
<!-- header area start -->


<!-- header area end -->
@yield('admin')
@php $baseurl = json_encode(url('/')); @endphp

<script>
    
    function getSiteUrl() {
        var BASE_URL = "<?php $baseurl ?>"; 
        return BASE_URL;
    }
</script>
@include('admin.includes.footer')