<header class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: white;">
      <a class="navbar-brand" href="/">{{config('blog.title')}}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item @if(!$slug)active @endif">
                <a class="nav-link" href="/">首页</a>
            </li>
            @foreach($columns as $column)
            <li class="nav-item @if($slug==$column->slug)active @endif">
                <a class="nav-link" href="{{url('/index',['column'=>$column->slug])}}">{{$column->title}}</a>
            </li>
            @endforeach
        </ul>
        <form class="form-inline my-2 my-lg-0" method="GET" action="{{url('/index')}}">
          <input class="form-control mr-sm-2" type="search" name="keyword" value="{{$keyword or ''}}" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
        </form>
      </div>
    </nav>
</header>
