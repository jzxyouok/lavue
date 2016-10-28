<style>
    .dz-max-files-reached {
        border: 2px solid rgba(238,57,57,.3) !important;
    }
</style>
<template>
    <div class="dropzone" id="myDropzone">
        <div class="am-text-success dz-message">
            将文件拖拽到此处<br>或点此打开文件管理器选择文件
        </div>


        <div class="dz-preview dz-file-preview">
            <div class="dz-details">
                <div class="dz-filename"><span data-dz-name></span></div>
                <div class="dz-size" data-dz-size></div>
                <img data-dz-thumbnail />
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
            <div class="dz-success-mark"><span></span></div>
            <div class="dz-error-mark"><span>✘</span></div>
            <div class="dz-error-message"><span data-dz-errormessage></span></div>
        </div>

    </div>
</template>
<script>
    import Dropzone from 'dropzone';
    import 'dropzone/dist/dropzone.css';

    export default{
        props: {
            url: {
                required: true,
                type: String
            },
            maxUpload: {
                required: false,
                type: Number,
                default: 1
            }
        },
        ready: function () {
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("#myDropzone", {
                url: this.url,
                acceptedFiles: 'image/*',
                addRemoveLinks: true,
                dictRemoveFile: '删除图片',
                method: 'post',
                filesizeBase: 1024,
                uploadMultiple: this.maxUpload > 1,
                maxFiles: this.maxUpload,
                dictMaxFilesExceeded: '最多可同时上传' + this.maxUpload + '张图片',
                success: function (file, response, e) {

                }
            });
        }
    }
</script>
<style>
</style>
