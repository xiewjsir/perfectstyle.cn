@extends('layouts.default')

@section('sidebar')
<div class="d-flex flex-column bg-white p-3" id="category-box">
    <div class="h2 sidebar-title">文章目录</div>
    <div class="text-muted" id="category"></div>
</div>
@endsection

@section('content')
<div class="info-box">
    <h2>{{$post->title}}</h2>
    <div class="autor border-bottom" style="border-color:1px solid #f7f7f7; ">
        <span class="lm">{!! $post->tag_links !!}</span>
        <span class="dtime">{{$post->release_at}}</span>
        <span class="viewnum">浏览（<a href="{{url('/detail/'.$post->slug)}}">{{$post->views+1}}</a>）</span>
    </div>
    <div class="markdown" style="padding: 10px;">
        {!! $post->content_html !!}
    </div>
</div>
<link rel="stylesheet" href="http://yandex.st/highlightjs/6.2/styles/googlecode.min.css">

<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="http://yandex.st/highlightjs/6.2/highlight.min.js"></script>

<script>hljs.initHighlightingOnLoad();</script>
<script type="text/javascript">
 $(document).ready(function(){
      $(".markdown h2,.markdown h3,.markdown h4,.markdown h5,.markdown h6").each(function(i,item){
        var tag = $(item).get(0).localName;
        $(item).attr("id","wow"+i);
        $("#category").append('<a class="new'+tag+'" href="#wow'+i+'" style="color:#555;padding:10px;">'+$(this).text()+'</a></br>');
        $(".newh2").css("margin-left",0);
        $(".newh3").css("margin-left",0);
        $(".newh4").css("margin-left",40);
        $(".newh5").css("margin-left",60);
        $(".newh6").css("margin-left",80);
      });
 });


    var name = "#category-box";
    var menuYloc = null;

    $(document).ready(function(){
        menuYloc = parseInt($(name).css('position','relative').css("top").substring(0,$(name).css("top").indexOf("px")))
        $(window).scroll(function () {
            offset = menuYloc+$(document).scrollTop()+"px";
            $(name).animate({top:offset},{duration:500,queue:false});
        });
    });
</script>
@endsection
