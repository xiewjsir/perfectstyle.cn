@extends('admin.layouts.default')
@section('content')
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">文章列表</h1>
        <div style="margin-right: -25px;width: 300px;display: table-cell;vertical-align: bottom;text-align: right;">
            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}">首页</a></li>
                <li class="active">文章列表</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->
        </div>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <div class="panel">


            <!--Data Table-->
            <!--===================================================-->
            <div class="panel-body">
                <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button id="btn-add" class="btn btn-primary"><i class="demo-pli-add"></i>&nbsp;写文章</button>
                            </div>
                            <div class="col-sm-6 table-toolbar-right">
                                <form name="search-form" action="{{Route('post.index')}}" method="GET" >
                                    <div class="form-group">
                                        <input name="keyword" id="keyword" value="{{request()->get('keyword')}}" type="text" placeholder="Search" class="form-control" id="demo-input-search2" autocomplete="off">
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-default"><i class="demo-pli-download-from-cloud"></i></button>
                                        <button class="btn btn-primary" type="submit" id="screen-btn"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>栏目</th>
                            <th>标签</th>
                            <th>排序</th>
                            <th>发布</th>
                            <th>添加时间</th>
                            <th>更新时间</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td><a class="btn-link" href="#">{{$post->id}}</a></td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->column_str}}</td>
                                <td>{!!$post->backend_tag_links!!}</td>
                                <td>
                                    <span class="badge badge-purple">{{$post->sort}}</span>
                                </td>
                                <td>
                                    <input class="post-status" data-id={{$post->id}} type="checkbox" @if('publish' == $post->post_status) checked @endif>
                                </td>
                                <td><span class="text-muted"><i class="demo-pli-clock"></i>&nbsp;{{$post->created_at}}</span></td>
                                <td><span class="text-muted"><i class="demo-pli-clock"></i>&nbsp;{{$post->updated_at}}</span></td>
                                <td class="text-center td-handle">
                                    <a href="{{route('post.edit',['id'=>$post->id])}}" alt="edit"><i class="fa fa-edit fa-lg"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-right pagination">
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>
            </div>
            <!--===================================================-->
            <!--End Data Table-->

        </div>
    </div>
    <!--===================================================-->
    <!--Switchery [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/switchery/switchery.min.js')}}"></script>
    <!--Switchery [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
    <!--Ion Icons [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <script src="{{asset('niftyadmin/plugins/layer/layer.js')}}"></script>
    <!--End page content-->
    <script type="text/javascript">
        $(function(){
            $("#btn-add").click(function(){
                document.location.href="{{route('post.create')}}";
            });

            var elems = Array.prototype.slice.call(document.querySelectorAll('.post-status'));
            elems.forEach(function(checkbox) {
                var switchery = new Switchery(checkbox, {color:'#35b9e7'});
                checkbox.onchange = function(){
                    $.ajax({
                        type: 'put',
                        url: '{{Route("api.post.updateField")}}',
                        data: {id:$(this).attr('data-id'),publish:checkbox.checked ? 1 : 0},
                        dataType: 'json',
                        success: function (result) {
                            if (200 != result['code']) {
                                layer.msg(result['message'], {time: 2000, icon: 2}, function () {
                                    location.href = "{{Route('post.index')}}"
                                });
                            }
                        },
                        error: function (msg) {
                            layer.msg(msg, {time: 2000, icon: 2});
                        }
                    });
                }
            });
        })
    </script>
@endsection