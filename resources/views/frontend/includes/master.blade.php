@include('frontend.includes.header')
<!-- header area end -->
@php $baseurl = json_encode(url('/')); @endphp

<script>

    function getSiteUrl() {
        var BASE_URL = "<?php $baseurl ?>";
        return BASE_URL;
    }
</script>
@yield('frontend')
@include('frontend.includes.footer')
