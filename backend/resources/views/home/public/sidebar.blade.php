<div class="d-flex flex-column sidebar">
    <div class="card w-100 border-0" style="background: #FFF url(../images/banner.png) no-repeat top center;
overflow: hidden;padding-top: 80px;">
      <img class="card-img-top rounded-circle" src="/upload/{{$profile->page_image}}" alt="Card image cap" style="margin:0 auto;width: 100px;height: 100px;">
      <div class="card-body text-center">
        <h5 class="card-title">{{$profile->title}}</h5>
        <p class="card-text">{{$profile->content_html}}</p>
      </div>
    </div>
    <div class="cloud sidebar-item">
      <h2 class="sidebar-title">标签云</h2>
      <ul>
        @foreach($tags as $tag)
        <a href="/">{{$tag->title}}</a>&nbsp;
        @endforeach
      </ul>
    </div>
    <div class="last-post sidebar-item">
        <h2 class="sidebar-title">点击排行</h3>
        <ul>
          @foreach($posts_by_views as $post)
          <li>
            <a href="{{url('/detail/'.$post->slug)}}">{{$loop->iteration}}、{{$post->title}}</a>
          </li>
          @endforeach
        </ul>
    </div>
</div>
