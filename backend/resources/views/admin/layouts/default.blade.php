<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$pageTitle ?? config('blog.title')}}</title>

        <!--STYLESHEET-->
        <!--=================================================-->

        <!--Open Sans Font [ OPTIONAL ]-->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


        <!--Bootstrap Stylesheet [ REQUIRED ]-->
        <link href="{{asset('niftyadmin/css/bootstrap.min.css')}}" rel="stylesheet">


        <!--Nifty Stylesheet [ REQUIRED ]-->
        <link href="{{asset('niftyadmin/css/nifty.min.css')}}" rel="stylesheet">


        <!--Nifty Premium Icon [ DEMONSTRATION ]-->
        <link href="{{asset('niftyadmin/css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">



        <!--Demo [ DEMONSTRATION ]-->
        <link href="{{asset('niftyadmin/css/demo/nifty-demo.min.css')}}" rel="stylesheet">


        <!--Magic Checkbox [ OPTIONAL ]-->
        <link href="{{asset('niftyadmin/plugins/magic-check/css/magic-check.min.css')}}" rel="stylesheet">

        <!--JAVASCRIPT-->
        <!--=================================================-->

        <!--Pace - Page Load Progress Par [OPTIONAL]-->
        <link href="{{asset('niftyadmin/plugins/pace/pace.min.css')}}" rel="stylesheet">
        <script src="{{asset('niftyadmin/plugins/pace/pace.min.js')}}"></script>


        <!--jQuery [ REQUIRED ]-->
        <script src="{{asset('niftyadmin/js/jquery-2.2.4.min.js')}}"></script>


        <!--BootstrapJS [ RECOMMENDED ]-->
        <script src="{{asset('niftyadmin/js/bootstrap.min.js')}}"></script>


        <!--NiftyJS [ RECOMMENDED ]-->
        <script src="{{asset('niftyadmin/js/nifty.min.js')}}"></script>

        <link href="{{asset('css/base.css')}}" rel="stylesheet">
    </head>
    <body>
        <div id="container" class="effect aside-float aside-bright mainnav-lg">

            <!--NAVBAR-->
            <!--===================================================-->
            @include('admin.public.navbar')
            <!--===================================================-->
            <!--END NAVBAR-->

            <div class="boxed">
                <!--CONTENT CONTAINER-->
                <!--===================================================-->
                <div id="content-container">
                    @yield('content')
                </div>
                <!--===================================================-->
                <!--END CONTENT CONTAINER-->

                <!--ASIDE-->
                <!--===================================================-->
                @include('admin.public.aside')
                <!--===================================================-->
                <!--END ASIDE-->


                <!--MAIN NAVIGATION-->
                <!--===================================================-->
                @include('admin.public.mainnav')
                <!--===================================================-->
                <!--END MAIN NAVIGATION-->
            </div>


            <!-- FOOTER -->
            <!--===================================================-->
            @include('admin.public.footer')
            <!--===================================================-->
            <!-- END FOOTER -->


            <!-- SCROLL PAGE BUTTON -->
            <!--===================================================-->
            @include('admin.public.scroll')
            <!--===================================================-->
        </div>
    </body>
</html>
