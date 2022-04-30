<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.4, shrink-to-fit=no" />
        <meta name="description" content="канцтовары в душанбе, канцелярия в душанбе, канцелярские товары, купить канцелярские товары в душанбе, ручки, карандаши, бумага а4 купить в душанбе">
        <meta name="google-site-verification" content="cwMpQTO0D0WvcjcseGlSctAC7umI7P8u2UkCEdXXOlg" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME') }}</title>

        <!-- Favicons -->
        {{--    <link rel="shortcut icon" href="/img/favicon.ico">--}}

        <!-- Css Styles -->
        <link rel="stylesheet" type="text/css" href="/lib/fontawesome/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="/lib/line-awesome/css/line-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/lib/bootstrap-4.3.1.min.css">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    @include('header')
    <div class="min-height-container">
        @yield('content')
    </div>
    @include('footer')

    <!-- page-loader -->
    <div class="page-loader" id="page_loader">
        <div class="page-loader-bar"></div>
    </div>
    <!-- page-loader -->

    <script src="/lib/jquery-3.4.1.min.js"></script>
    <script src="/lib/popper-1.14.6.min.js"></script>
    <script src="/lib/bootstrap-4.3.1.min.js"></script>
    <script src="/lib/sortable-1.10.2.min.js"></script>
    <script src="/js/app.js"></script>
    </body>
</html>
