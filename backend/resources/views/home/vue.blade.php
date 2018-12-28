<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>test</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="app"><example-component></example-component></div>
        <div id='myApp' class='text-center px-5'>
            <div id="myApp">
    <nba-all-stars c="奥尼尔" pf="加内特">
        <span slot="sf">皮尔斯</span>
        <span slot="sg">雷阿伦</span>
        <span slot="pg">隆多</span>
    </nba-all-stars>
            </div>
        </div>
    </body>
    <script src="{{asset('js/app.js')}}"></script> 
    <script>
    Vue.component('nba-all-stars', {
        props: ['c', 'pf'],
        template: '<div>'
            + '<div>中锋：@{{c}}</div>'
            + '<div>大前：@{{pf}}</div>'
            + '<div>小前：<slot name="sf"></slot></div>'
            + '<div>分卫：<slot name="sg"></slot></div>'
            + '<div>控卫：<slot name="pg"></slot></div>'
            + '</div>',
    });
    var myApp = new Vue({
        el: '#myApp',
    });
    </script>    
</html>
