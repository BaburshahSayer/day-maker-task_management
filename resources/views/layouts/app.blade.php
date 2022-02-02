<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .navbar-brand{
            font-size: 1.5rem !important;
        }
        section{
            cursor: move;
        }
        .parent{
            min-height:80px;
        }
        .border-bottom {
           border: 1px dashed #dee2e6 !important;
        }
        section{
          margin-bottom: 5px;
        }
        .task-description {
            font-size: 0.8em;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.navbar')
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                             @include('messages.flash_message')
                             @yield('content')
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
{{-- // drag and drop nessesery content --}}
<script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery/jquery-ui.js')}}"></script>
<script>
    //ajax submit token generate 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });    
</script>
@stack('js')
</html>
