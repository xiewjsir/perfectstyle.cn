@extends('admin.layouts.default')
@section('content')
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">上传图片</h1>
        <div style="margin-right: -25px;width: 300px;display: table-cell;vertical-align: bottom;text-align: right;">
            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}">首页</a></li>
                <li><a href="{{route('post.index')}}">图片列表</a></li>
                <li class="active">上传图片</li>
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
            <form id="posts-form" action="{{Route('post.store')}}" class="panel-body form-horizontal form-padding">
                {{csrf_field()}}
                <input type="hidden" name="file_ids" id="file_ids" value="">
                <div class="form-group">
                    <label class="col-md-1 control-label" for="demo-text-input">标题</label>
                    <div class="col-md-11">
                        <input type="text" name="title" id="title" class="form-control" placeholder="标题">
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
            </form>
            <!--===================================================-->
            <!-- END BASIC FORM ELEMENTS -->
        </div>
    </div>
    <script src="{{asset('niftyadmin/plugins/layer/layer.js')}}"></script>
    <link href="{{asset('niftyadmin/plugins/dropzone/dropzone.css')}}" rel="stylesheet">
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
        $(function(){
            Dropzone.options.myAwesomeDropzone = false;
            Dropzone.autoDiscover = false;
            var fileArr = new Array();
            var previewNode = document.querySelector(".dz-preview");
            previewNode.id = "";
            var previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);
            $(".dropzone").dropzone({
                url: "{{Route('file.upload')}}",
                dictRemoveFile:"移除文件",
                addRemoveLinks:true,
                previewTemplate: previewTemplate,
                thumbnailWidth:120,
                thumbnailHeight:120,
                init: function () {
                    this.on("success", function (file, data) {
                        var fileId = '';
                        if(typeof(data.data) != 'undefined'){
                            fileId = data.data.file_id;
                        }else if(typeof(file.id) != 'undefined'){
                            fileId = file.id;
                        }
                        fileArr[file.upload.uuid] = fileId;

                        handleFileIds(fileId,'add');
                    });

                    this.on("removedfile", function (file, data) {
                        handleFileIds(fileArr[file.upload.uuid],'remove');
                    });
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