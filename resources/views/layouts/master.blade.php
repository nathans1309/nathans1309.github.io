    <html>
    <head>
        <title>Amplify Social</title>
        <link rel="stylesheet" href="{{ url('css/app.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>

    <body>
        @include('layouts/header')

        @hasSection('title')
        <div class="page-header">
            <h1>@yield('title')</h1>
        </div>
        @endif

        <div class="container-fluid">
            @yield('content')
        </div>

        @yield('modal')

        <!-- scripts -->
        <script src="{{ url('lib/jquery/dist/jquery.min.js') }}"></script>
        <script src = "{{ url('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        <footer class = "footer">
            <div class="container">
                <p class="text-muted">
                    &#169; Copyright 2016 - ChurchWise Solutions
                </p>
            </div>
        </footer>
    </body>
</html>