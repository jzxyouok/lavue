<style>
    .m-img-list {
        list-style: none;
        padding-left: 0;
    }
    .m-img-list li {
        text-align: center;
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
        width: 250px;
        height: 250px;
        position: relative;
        border-radius: 5px;
        padding: 3px;
        border: 1px solid #d3d3d3;
    }
    .m-img-list img {
        width: auto;
        height: auto;
        max-width: 100%;
        max-height: 100%;
    }
    .m-img-list li .u-handle {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        font-size: 0;
        background: rgba(0, 0, 0, .5);
    }
    .m-img-list li .u-handle a.btn {
        font-size: 14px;
        width: 100%;
        color: #fff;
    }
    .dz-image-preview {
        display: none !important;
    }
</style>
<template>
    <div>
        <input class="file-upload-btn btn btn-primary" :disabled="maxFiles<=images.length" value="选择上传" >
        <div class="m-t">
            <ul class="m-img-list clearfix preview-container">
                <li v-for="image in images">
                    <img data-dz-thumbnail :src="image">
                    <div class="u-handle">
                        <a class="btn btn-link" @click="removeImage(image, $index)">删除</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import Dropzone from 'dropzone';

    export default {
        props: {
            images: {
                required: false,
                type: Array,
                default: function () {
                    return [];
                }
            },
            url: {
                required: true,
                type: String
            },
            maxFiles: {
                required: false,
                type: Number,
                default: 1
            }
        },
        data: function () {
            return {
                uploadImages: [],
                fileImageMap: []
            }
        },
        ready: function () {
            let self = this;

            let header = Auth.getAuthHeader();

            let myDropzone = new Dropzone(this.$el, {
                url: self.url,
                // 为避免多选时设置超出最大文件数量，因此每次只能单选
                uploadMultiple: false,
                maxFiles: this.maxFiles,
                previewsContainer: null,
                clickable: ".file-upload-btn",
                headers: {[header.key]: header.value}
            });
            myDropzone.on("addedfile", function (file) {
                self.loadImageByFile(file);
            });
            myDropzone.on("success", function (file, response) {
                self.$dispatch('upload-success', response, file);
                /**
                 * 上传成功后就把队列中的文件删除，
                 * 因为实际上并没有用到Dropzone提供的队列，
                 * 如果不删除可能会导致队列文件大于设置可上传的数量，导致无法上传
                 */
                this.removeFile(file);
            })
            myDropzone.on("error", function (file, errorMessage, response) {
                swal({
                    title: '图片上传失败，请稍后再试~',
                    type: 'warning',
                    timer: 1700
                })
                self.removeImageByFile(file);

                self.$dispatch('upload-fail', response, file);
            })
        },
        methods: {
            loadImageByFile: function (file) {
                this.uploadImages.push(file);
                let index = this.uploadImages.indexOf(file);
                let the = this;
                var reader = new FileReader();
                reader.onload = function (e) {
                    let image = reader.result;
                    the.fileImageMap[index] = image;
                    the.images.push(image);
                };
                reader.readAsDataURL(file);
            },
            removeImageByFile: function (file) {
                let index = this.uploadImages.indexOf(file);
                this.images.$remove(this.fileImageMap[index]);
            },
            removeImage: function (image, index) {
                this.images.$remove(image);

                this.$dispatch('delete-image', image, index);
            }
        }
    }
</script>