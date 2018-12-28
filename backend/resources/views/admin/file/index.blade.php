@extends('admin.layouts.default')
@section('content')
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">图片列表</h1>
        <div style="margin-right: -25px;width: 300px;display: table-cell;vertical-align: bottom;text-align: right;">
            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}">首页</a></li>
                <li class="active">图片列表</li>
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
                                <button id="btn-add" class="btn btn-primary"><i class="fa fa-cloud-upload"></i>&nbsp;上传图片</button>
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
                            <th>类型</th>
                            <th>关联</th>
                            <th>图片</th>
                            <th>添加时间</th>
                            <th>更新时间</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                            <tr>
                                <td><a class="btn-link" href="#">{{$file->id}}</a></td>
                                <td>{{$file->title}}</td>
                                <td>{{$file->type}}</td>
                                <td></td>
                                <td><img src="{{Storage::url($file->path) }}" alt="{{$file->title}}" width="120"/></td>
                                <td><span class="text-muted"><i class="demo-pli-clock"></i>&nbsp;{{$file->created_at}}</span></td>
                                <td><span class="text-muted"><i class="demo-pli-clock"></i>&nbsp;{{$file->updated_at}}</span></td>
                                <td class="text-center">
                                    <a href="{{route('file.edit',['id'=>$file->id])}}" alt="edit"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                                    <a href="{{route('file.destroy',['id'=>$file->id])}}" alt="destroy"><i class="fa fa-trash-o fa-lg"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-right pagination">
                            {{$files->links()}}
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
                document.location.href="{{route('file.create')}}";
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