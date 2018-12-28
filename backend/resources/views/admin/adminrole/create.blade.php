@extends('admin.layouts.default')
@section('content')
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">新增角色</h1>
        <div style="margin-right: -25px;width: 300px;display: table-cell;vertical-align: bottom;text-align: right;">
            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}">首页</a></li>
                <li><a href="{{route('adminRole.index')}}">角色列表</a></li>
                <li class="active">新增角色</li>
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
            <form id="admin-user-form" action="{{Route('adminRole.store')}}"
                  class="panel-body form-horizontal form-padding">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-1 control-label" for="name_cn">英文名称</label>
                    <div class="col-md-11">
                        <input type="text" name="name_en" id="name_en" value="" class="form-control" placeholder="中文名称">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="name_cn">中文名称</label>
                    <div class="col-md-11">
                        <input type="text" name="name_cn" id="name_cn" value="" class="form-control" placeholder="中文名称">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="description">描述</label>
                    <div class="col-md-11">
                        <textarea name="description" id="description" rows="9" class="form-control" placeholder="输入描述.."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="">&nbsp;</label>
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
            $("#admin-user-form").bootstrapValidator({
                fields: {
                    name_en: {
                        validators: {
                            notEmpty: {
                                message: '英文名称不能为空'
                            }
                        }
                    },
                    name_cn: {
                        validators: {
                            notEmpty: {
                                message: '中文名称不能为空'
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
                                location.href = "{{Route('adminRole.index')}}"
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