<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ecommerce - @yield('frontend_title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('forntend.layout.inc.style')

</head>

<body>
    <!--Start Preloader-->
    <div class="preloader-wrap">
        <div class="spinner"></div>
    </div>


    @include('forntend.layout.inc.search')

    @include('forntend.layout.inc.header')

    @yield('frontend_content')

    @include('forntend.layout.inc.newsletter')

    @include('forntend.layout.inc.footer')

    @include('forntend.layout.inc.modal')

    @include('forntend.layout.inc.script')

</body>
</html>
