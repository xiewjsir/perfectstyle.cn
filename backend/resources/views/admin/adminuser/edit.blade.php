@extends('admin.layouts.default')
@section('content')
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">编辑管理员</h1>
        <div style="margin-right: -25px;width: 300px;display: table-cell;vertical-align: bottom;text-align: right;">
            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}">首页</a></li>
                <li><a href="{{route('adminUser.index')}}">管理员列表</a></li>
                <li class="active">编辑管理员</li>
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
            <form id="admin-user-form" action="{{Route('adminUser.update',['id'=>$adminUser->id])}}"
                  class="panel-body form-horizontal form-padding">
                <input type="hidden" name="file_id" id="file_id" value="{{$adminUser->file_id}}">
                <input type="hidden" name="avatar" id="avatar" value="{{$adminUser->avatar}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">用户名</label>
                    <div class="col-md-11">
                        <input type="text" name="username" id="username" value="{{$adminUser->username}}" class="form-control" placeholder="用户名">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">名称</label>
                    <div class="col-md-11">
                        <input type="text" name="name" id="name" value="{{$adminUser->name}}" class="form-control" placeholder="名称">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">头像</label>
                    <div class="col-md-11">
                        <div class="dropzone">
                            <div class="dz-default dz-message">
                                <div class="dz-icon">
                                    <i class="demo-pli-upload-to-cloud icon-5x"></i>
                                </div>
                                <div>
                                    <span class="dz-text">Drop files to upload</span>
                                    <p class="text-sm text-muted">or click to pick manually</p>
                                </div>
                            </div>
                            <div class="fallback">
                                <input name="file" type="file">
                            </div>
                        </div>
                        @include('admin.public.dz-template')
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">邮箱</label>
                    <div class="col-md-11">
                        <input type="text" name="email" id="email" value="{{$adminUser->email}}" class="form-control" placeholder="邮箱">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">密码</label>
                    <div class="col-md-11">
                        <input type="password" name="password" id="password" value="" class="form-control" placeholder="密码">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">确认密码</label>
                    <div class="col-md-11">
                        <input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control" placeholder="确认密码">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">角色</label>
                    <div class="col-md-11">
                        <select name="roles[]" id="roles" multiple="multiple" class="form-control">
                            <option value="">选择角色...</option>
                            @foreach($adminRoles as $role)
                                <option value="{{$role->id}}"
                                        @if($adminUser->roles->contains($role->id)) selected @endif>{{$role->name}}</option>
                            @endforeach
                        </select>
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
    <!--Select2 [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Select2 [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/select2/js/select2.min.js')}}"></script>

    <!--Bootstrap Validator [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/bootstrap-validator/bootstrapValidator.min.js')}}"></script>

    <!--Bootstrap Validator [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/bootstrap-validator/bootstrapValidator.min.css')}}" rel="stylesheet">

    <script src="{{asset('niftyadmin/plugins/layer/layer.js')}}"></script>

    <!--Dropzone [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/dropzone/dropzone.css')}}" rel="stylesheet">

    <!--Dropzone [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/dropzone/dropzone.js')}}"></script>
    <style type="text/css">
        .dropzone{
            border: 1px solid #e9e9e9;
        }

        .dropzone .dz-preview .dz-image{
            position: relative;
            border-radius:5px;
        }

        .dropzone .dz-preview .dz-progress{
            height: 6px;
        }

        .dz-image .dz-remove{
            position: absolute;
            top: 2px;
            right: 2px;
            opacity:0.6;
        }
    </style>
    <script type="text/javascript">
        $(function () {
            $("#roles").select2();

            $("#admin-user-form").bootstrapValidator({
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: '用户名不能为空'
                            }
                        }
                    },
                    name: {
                        validators: {
                            notEmpty: {
                                message: '名称不能为空'
                            }
                        }
                    }
                }
            }).on('success.form.bv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                $.ajax({
                    type: 'put',
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function (result) {
                        if (200 == result['code']) {
                            layer.msg(result['message'], {time: 2000, icon: 1}, function () {
                                location.href = "{{Route('adminUser.index')}}"
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

            Dropzone.options.myAwesomeDropzone = false;
            Dropzone.autoDiscover = false;
            var previewNode = document.querySelector(".dz-preview");
            previewNode.id = "";
            var previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);
            $(".dropzone").dropzone({
                url: "{{Route('file.upload',['type'=>'avatar'])}}",
                maxFiles: 1,
                addRemoveLinks:false,
                previewTemplate: previewTemplate,
                thumbnailWidth:120,
                thumbnailHeight:120,
                init: function () {
                    this.on("success", function (file, data) {
                        if(typeof(data.data) != 'undefined'){
                            $("#file_id").val(data.data.file.id);
                            $("#avatar").val(data.data.file.path);
                        }
                    });

                    this.on("removedfile", function (file, data) {
                        $.ajax({
                            type: 'delete',
                            url: '/admin/file/'+$("#file_id").val(),
                            dataType: 'json',
                            success: function (result) {
                                if (200 == result['code']) {
                                    $("#file_id").val('');
                                    $("#avatar").val('');
                                }
                            },
                            error: function (msg) {
                                layer.msg(msg, {time: 2000, icon: 2});
                            }
                        });
                    });

                    @if($adminUser->avatar)
                        var mockFile = {name:'{{$adminUser->name}}',size: 10000,type: '.jpg,.png,.gif'};
                        this.addFile.call(this, mockFile);
                        this.options.thumbnail.call(this, mockFile, "{{Storage::url($adminUser->avatar) }}");
                    @endif
                }
            });
        });
    </script>
@endsection