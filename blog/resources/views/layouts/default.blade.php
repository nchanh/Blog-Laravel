<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    <div class="container-fluid">

        <header class="row">
            @include('includes.header')
        </header>

        <div id="main" class="container mt-4">
            @yield('content')
        </div>

        <footer class="container">
            @include('includes.footer')
        </footer>

        {{-- JQUERY --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        {{-- Bootstrap 5 --}}
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        <script>
            setTimeout(function(){
                $('#message_time').hide(); // hide message
            }, 5000); // 5000ms
        </script>
    </div>
</body>
</html>
