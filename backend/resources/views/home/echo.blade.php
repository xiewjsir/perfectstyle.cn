<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>

    <title>{{$title or config('blog.title')}}</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/main.css')}}" rel="stylesheet" type="text/css">
    <style>

    </style>
</head>
<body>
<main style="margin-top:30px; ">
    <div class="container clearfix" id="app">

    </div>
</main>
</body>
<script src="{{asset('js/app.js')}}"></script>
<script>
    console.log(Echo);
    Echo.channel('news-test')
        .listen('.Newscc', (e) => {
            $("#app").html('<div style="border-radius:5%;margin:0 auto;line-height:22px;padding-left: 3px;background-color:pink;">'+e.message+'</div>');
        });

    // let user_id = 1;
    // Echo.private('order-'+user_id)
    //     .listen('.order.shipping', (e) => {
    //         console.log(e.user_id);
    //     });
</script>
</html>

