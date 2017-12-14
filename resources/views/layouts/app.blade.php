<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ str_replace( '_'," ", config( 'app.name', 'Pro School' ) ) }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="theme-red">

    <div id="app">

        @include( 'layouts.page-loader' )
        @include( "layouts.search-bar" )
        @include( "layouts.top-bar" )
        @include( "layouts.menu" )
            

        @yield( 'content' )
    </div>
    {{--  node waves  --}}
    <script src="{{ asset('js/waves.min.js') }}"></script>
    {{--  Raphael chart  --}}
    <script src="{{ asset('js/raphael.min.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    {{--  include custom scripts according the page  --}}
    @if ( Route::CurrentRouteName() == "user-category" )
        @include ( 'scripts.dashboard.user-category' )
    @endif
    
</body>
</html>
