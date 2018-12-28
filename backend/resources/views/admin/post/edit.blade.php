@extends('admin.layouts.default')
@section('content')
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">编辑文章</h1>
        <div style="margin-right: -25px;width: 300px;display: table-cell;vertical-align: bottom;text-align: right;">
            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}">首页</a></li>
                <li><a href="{{route('post.index')}}">文章列表</a></li>
                <li class="active">编辑文章</li>
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
            <form id="posts-form" action="{{Route('post.update',['id'=>$post->id])}}"
                  class="panel-body form-horizontal form-padding">
                <input type="hidden" name="file_ids" id="file_ids" value="">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">标题</label>
                    <div class="col-md-11">
                        <input type="text" name="title" id="title" value="{{$post->title}}" class="form-control" placeholder="标题">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">栏目</label>
                    <div class="col-md-11">
                        <!-- Default choosen -->
                        <!--===================================================-->
                        <select name="column_id" id="column_id" data-placeholder="选择栏目..." tabindex="2">
                            <option value="">选择栏目...</option>
                            @foreach($columns as $column)
                                <option value="{{$column->id}}"
                                        @if($post->column_id == $column->id) selected @endif>{{$column->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">标签</label>
                    <div class="col-md-11">
                        <input type="text" name="tag_names" id="tag_names" value="{{$post->tag_names}}"
                               class="form-control" placeholder="Add a tag" value="" data-role="tagsinput">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">概要</label>
                    <div class="col-md-11">
                        <textarea type="text" name="summary" id="summary" rows="3" class="form-control"
                                  placeholder="概要">{{$post->summary}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">图片</label>
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
                                <input name="file" type="file" multiple>
                            </div>
                        </div>
                        @include('admin.public.dz-template')
                    </div>
                </div>
                <!--Textarea-->
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-textarea-input">内容</label>
                    <div class="col-md-11">
                        <textarea name="content" id="content" data-provide="markdown"
                                  rows="10">{{$post->content}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-textarea-input">&nbsp;</label>
                    <div class="col-md-11">
                        <button id="publish" class="btn btn-primary" type="submit">发布</button>
                        <button class="btn btn-warning" type="reset">重置</button >
                    </div>
                </div>
            </form>
            <!--===================================================-->
            <!-- END BASIC FORM ELEMENTS -->
        </div>
    </div>
    <!--Switchery [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css')}}" rel="stylesheet">
    <!--Chosen [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/chosen/chosen.min.css')}}" rel="stylesheet">
    <!--Select2 [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <!--===================================================-->

    <!--Demo script [ DEMONSTRATION ]-->
    <script src="{{asset('niftyadmin/js/demo/nifty-demo.min.js')}}"></script>


    <!--Switchery [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/switchery/switchery.min.js')}}"></script>


    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>


    <!--Chosen [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/chosen/chosen.jquery.min.js')}}"></script>

    <!--Select2 [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/select2/js/select2.min.js')}}"></script>


    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js')}}"></script>


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>


    <!--Form Component [ SAMPLE ]-->
    <script src="{{asset('niftyadmin/js/demo/form-component.js')}}"></script>


    <!--Bootstrap Markdown [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet">

    <!--Markdown [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/bootstrap-markdown/js/markdown.js')}}"></script>


    <!--ToMarkdown [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/bootstrap-markdown/js/to-markdown.js')}}"></script>


    <!--Bootstrap Markdown [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/bootstrap-markdown/js/bootstrap-markdown.js')}}"></script>


    <!--Bootstrap Validator [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/bootstrap-validator/bootstrapValidator.min.js')}}"></script>
    <!--Masked Input [ OPTIONAL ]-->
    <script src="{{asset('niftyadmin/plugins/masked-input/jquery.maskedinput.min.js')}}"></script>

    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{asset('niftyadmin/plugins/magic-check/css/magic-check.min.css')}}" rel="stylesheet">

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
            $("#posts-form").bootstrapValidator({
                message: '表单内容不符合要求',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    title: {
                        message: '标题不符合要求',
                        validators: {
                            notEmpty: {
                                message: '标题不能为空'
                            }
                        }
                    },
                    column_id: {
                        validators: {
                            notEmpty: {
                                message: '栏目不能为空'
                            }
                        }
                    },
                    content: {
                        validators: {
                            notEmpty: {
                                message: '内容不能为空'
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
                            layer.msg('编辑文章成功', {time: 2000, icon: 1}, function () {
                                location.href = "{{Route('post.index')}}"
                            });
                        } else {
                            layer.msg(result['message'], {time: 2000, icon: 2});
                            $form.bootstrapValidator('disableSubmitButtons', false);
                        }
                    },
                    error: function (msg) {
                        layer.msg(msg, {time: 2000, icon: 2});
                        $form.bootstrapValidator('disableSubmitButtons', false);
                    }
                });

                return false;
            });

            Dropzone.options.myAwesomeDropzone = false;
            Dropzone.autoDiscover = false;
            var fileArr = new Array();
            var previewNode = document.querySelector(".dz-preview");
            previewNode.id = "";
            var previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);
            $(".dropzone").dropzone({
                url: "{{Route('file.upload')}}",
                //dictRemoveFile:"移除文件",
                addRemoveLinks:false,
                previewTemplate: previewTemplate,
                thumbnailWidth:120,
                thumbnailHeight:120,
                init: function () {
                    this.on("success", function (file, data) {
                        var fileId = '';
                        if(typeof(data.data) != 'undefined'){
                            fileId = data.data.file.id;
                        }else if(typeof(file.id) != 'undefined'){
                            fileId = file.id;
                        }
                        fileArr[file.upload.uuid] = fileId;

                        handleFileIds(fileId,'add');
                    });

                    this.on("removedfile", function (file, data) {
                        handleFileIds(fileArr[file.upload.uuid],'remove');
                    });

                    @foreach($post->files as $file)
                        var mockFile = {id:'{{$file->id}}',name:'{{$file->title}}',size: 10000,type: '.jpg,.png,.gif'};
                        this.addFile.call(this, mockFile);
                        this.options.thumbnail.call(this, mockFile, "{{Storage::url($file->path) }}");
                    @endforeach

                }
            });
        });

        function handleFileIds(fileId,type){
            var fileIdArr = new Array();
            fileIdArr = $("#file_ids").val().split(",");
            fileId += "";

            if('add' == type){
                if(fileIdArr.indexOf(fileId) == -1){
                    fileIdArr.push(fileId);
                }
            }else{
                var index = fileIdArr.indexOf(fileId);
                if(index > -1){
                    fileIdArr.splice(index,1);
                }
            }

            $("#file_ids").val(fileIdArr.join(","));
        }
    </script>
@endsection