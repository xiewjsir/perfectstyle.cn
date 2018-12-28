<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$title or config('blog.title')}}</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/main.css')}}" rel="stylesheet" type="text/css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <style>

        </style>
    </head>
        <body>
            @include('public.nav')
            <main style="margin-top:30px; ">
                <div class="container clearfix">
                    <div class="row">
                        <div class="col-8">
                            @yield('content')
                        </div>
                       <div class="col-4 pl-4" id="sidebar">
                            @yield('sidebar')
                        </div>
                    </div>
                </div>
            </main>
            @include('public.footer')
        </body>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        $(function () {
            'use strict';
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</html>
