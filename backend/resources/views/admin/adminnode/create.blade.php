@extends('admin.layouts.default')
@section('content')
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">编辑节点</h1>
        <div style="margin-right: -25px;width: 300px;display: table-cell;vertical-align: bottom;text-align: right;">
            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}">首页</a></li>
                <li><a href="{{route('adminNode.index')}}">节点列表</a></li>
                <li class="active">编辑节点</li>
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
            <!-- BASIC FORM ELEMENTS -->
            <!--===================================================-->
            <form id="admin-user-form" action="{{Route('adminNode.store')}}"
                  class="panel-body form-horizontal form-padding">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">名称</label>
                    <div class="col-md-11">
                        <input type="text" name="name" id="name" value="" class="form-control" placeholder="输入名称">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">父级节点</label>
                    <div class="col-md-11">
                        <select name="parent_id" id="parent_id" class="form-control">
                            {!! $adminNodeTree !!}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">类型</label>
                    <div class="col-md-11">
                        <div class="radio">
                            <!-- Inline radio buttons -->
                            <input name="type" id="type_menu" class="magic-radio" type="radio" value="menu" checked="">
                            <label for="type_menu">菜单</label>
                            <input name="type" id="type_function" class="magic-radio" type="radio" value="function" checked="">
                            <label for="type_function">功能</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">图标</label>
                    <div class="col-md-11">
                        <input type="text" name="icon" id="icon" value="" class="form-control" placeholder="输入图标">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">HTTP方法</label>
                    <div class="col-md-11">
                        <select name="method[]" id="method" multiple class="form-control">
                            @foreach($methods as $method)
                                <option value="{{$method}}">{{$method}}</option>
                            @endforeach
                        </select>
                        <span class="help-block"><i class="fa fa-info-circle"></i>&nbsp;为空默认为所有方法</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">路由</label>
                    <div class="col-md-11">
                        <input type="text" name="uri" id="uri" value="" class="form-control" placeholder="输入路由">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-textarea-input">&nbsp;</label>
                    <div class="col-md-11">
                        <button id="publish" class="btn btn-primary" type="submit">提交</button>
                        <button class="btn btn-warning" type="reset">重置</button >
                    </div>
                </div>
            </form>
            <!--===================================================-->
            <!-- END BASIC FORM ELEMENTS -->
        </div>
    </div>
    <link href="{{asset('niftyadmin/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('niftyadmin/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!--Select2 [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Select2 [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/select2/js/select2.min.js')}}"></script>

    <!--Bootstrap Validator [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/bootstrap-validator/bootstrapValidator.min.js')}}"></script>

    <!--Bootstrap Validator [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/bootstrap-validator/bootstrapValidator.min.css')}}" rel="stylesheet">

    <script src="{{asset('niftyadmin/plugins/layer/layer.js')}}"></script>
    <style type="text/css">

    </style>
    <script type="text/javascript">
        $(function () {
            $("#parent_id").select2({
                templateSelection: formatSelection,
            });

            function formatSelection(state) {
                if (!state.id) { return state.text; }
                var $state = $(
                    '<span>' + state.text.replace(/^\s+|\s+$/gm,'') + '</span>'
                );
                return $state;
            };

            $("#method").select2();

            $("#admin-user-form").bootstrapValidator({
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: '节点不能为空'
                            }
                        }
                    },
                    icon: {
                        validators: {
                            notEmpty: {
                                message: '图标不能为空'
                            }
                        }
                    },
                    uri: {
                        validators: {
                            notEmpty: {
                                message: '路径不能为空'
                            }
                        }
                    }
                }
            }).on('success.form.bv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                $.ajax({
                    type: 'post',
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function (result) {
                        if (200 == result['code']) {
                            layer.msg(result['message'], {time: 2000, icon: 1}, function () {
                                location.href = "{{Route('adminNode.index')}}"
                            });
                        } else {
                            $form.bootstrapValidator('disableSubmitButtons', false);
                            layer.msg(result['message'], {time: 2000, icon: 2});
                        }
                    },
                    error: function (msg) {
                        layer.msg(msg, {time: 2000, icon: 2});
                    }
                });

                return false;
            });
        });
    </script>
@endsection