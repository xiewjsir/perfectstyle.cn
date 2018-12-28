<div class="posts-box">
    <div class="row m-0">
        <div class="col-12 info clearfix">
            <span class="image">
                <img src="/upload/{{$post->page_image}}" class="w-100" style="border-radius: 5px;">
            </span>
            <h3 class="title m-0"><a href="{{url('/detail/'.$post->slug)}}"> {{$post->title}}</a></h3>
            <p class="describe m-0">{{str_limit($post->content_html,300)}}</p>
        </div>
        <div class="col-12 autor">
            <span class="lm">{!! $post->tag_links !!}</span>
            <span class="dtime">{{$post->release_at}}</span>
            <span class="viewnum">浏览（<a href="{{url('/detail/'.$post->slug)}}">{{$post->views}}</a>）</span>
            <span class="readmore"><a href="{{url('/detail/'.$post->slug)}}">阅读原文</a></span>
        </div>
    </div>
</div>
