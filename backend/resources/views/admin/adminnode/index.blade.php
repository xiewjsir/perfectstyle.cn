@extends('admin.layouts.default')
@section('content')
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"> 节点列表</h1>
        <div style="margin-right: -25px;width: 300px;display: table-cell;vertical-align: bottom;text-align: right;">
            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li><a href="{{route('adminNode.index')}}">首页</a></li>
                <li class="active"> 节点列表</li>
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
                                <button id="btn-add" class="btn btn-primary"><i class="demo-pli-add"></i>&nbsp;新增</button>
                            </div>
                            <div class="col-sm-6 table-toolbar-right">
                                <form name="search-form" action="{{Route('adminNode.index')}}" method="GET" >
                                    <div class="form-group">
                                        <input name="keyword" id="keyword" value="{{request()->get('keyword')}}" type="text" placeholder="Search" class="form-control" id="input-search2" autocomplete="off">
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
                            <th>名称</th>
                            <th>上级</th>
                            <th>类型</th>
                            <th>路径</th>
                            <th>路由</th>
                            <th>按钮</th>
                            <th>排序</th>
                            <th>添加时间</th>
                            <th>更新时间</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($adminNodes as $adminNode)
                            <tr>
                                <td><a class="btn-link" href="#">{{$adminNode->id}}</a></td>
                                <td>{{$adminNode->name}}</td>
                                <td>{{$adminNode->parent_name}}</td>
                                <td>{{$adminNode->type_str}}</td>
                                <td>{{$adminNode->path}}</td>
                                <td>{!! $adminNode->method_str !!}{{$adminNode->uri}}</td>
                                <td><i class="fa-lg {{$adminNode->icon}}" style="color:#c3cac9;"></i></td>
                                <td>{{$adminNode->sort}}</td>
                                <td><span class="text-muted"><i class="pli-clock"></i>&nbsp;{{$adminNode->created_at}}</span></td>
                                <td><span class="text-muted"><i class="pli-clock"></i>&nbsp;{{$adminNode->updated_at}}</span></td>
                                <td class="text-center td-handle">
                                    <a href="{{route('adminNode.edit',['id'=>$adminNode->id])}}" alt="edit"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                                    <a href="{{route('adminNode.edit',['id'=>$adminNode->id])}}" alt="edit"><i class="fa fa-trash-o fa-lg"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-right pagination">
                            {{$adminNodes->links()}}
                        </div>
                    </div>
                </div>
            </div>
            <!--===================================================-->
            <!--End Data Table-->

        </div>
    </div>
    <!--===================================================-->
    <!--Ion Icons [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <script src="{{asset('niftyadmin/plugins/layer/layer.js')}}"></script>

    <!--End page content-->
    <script type="text/javascript">
        $(function(){
            $("#btn-add").click(function(){
                document.location.href="{{route('adminNode.create')}}";
            });
        })
    </script>
@endsection