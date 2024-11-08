<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- CSRF Token -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Software') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" media="all">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>

    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper" id="app">

            @guest

                {{-- Nothing --}}

            @else

                @include('parts.navbar')

                @include('parts.sidebar')

            @endguest

            <div class="content-wrapper" @guest style="margin-left: 0 !important" @endguest>

                @include('parts.messages')

                @yield('content')

            </div>

            @guest

                {{-- Nothing --}}

            @else
   
                @include('parts/modals')

                @include('parts/footer')

                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>

            @endguest


        </div>
        <!-- ./wrapper -->

        <!-- Scripts -->
        <script src="{{ asset('js/vendor.js') }}" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
