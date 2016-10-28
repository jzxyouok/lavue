<template>
    <validator name="vld">
    <form class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label">标题：</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" v-model="data.title" initial="off" detect-change="off" v-validate:title="['required']">
                <validation-error :field="$vld.title.required" :message="'请填写标题'"></validation-error>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-sm-2 control-label">预览图：</label>
            <div class="col-sm-10">
                <upload-image @upload-success="uploadSuccess" @delete-image="deleteImage"
                              :url="'/admin/uploadImg'" :max-files="1" :images="image"></upload-image>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-sm-2 control-label">分类：</label>

            <div class="col-sm-10">
                <select class="form-control" v-model="data.category_id" initial="off" detect-change="off" v-validate:category="['required']">
                    <option v-for="category in categories" :value="category.id">
                        {{ category.name }}
                    </option>
                </select>
                <validation-error :field="$vld.category.required" :message="'请选择分类'"></validation-error>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">摘要：</label>

            <div class="col-sm-10">
                <textarea class="form-control" v-model="data.summary" initial="off" detect-change="off" v-validate:summary="['required']"></textarea>
                <validation-error :field="$vld.summary.required" :message="'请填写摘要'"></validation-error>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">内容：</label>

            <div class="col-sm-10">
                <editor :model.sync="data.content" @editor-blur="editorBlur"></editor>
                <validation-error :field="!data.content && editor.blur" :message="'请填写内容'"></validation-error>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button type="submit" class="btn btn-primary"  @click.prevent="submit">提交</button>
                <a class="btn btn-white">取消</a>
            </div>
        </div>
    </form>
    </validator>
</template>

<script>
    import Editor from '../../components/editor.vue';
    import ValidationError from '../../components/validation/error.vue';
    import UploadImage from '../../components/upload-image.vue';
    import Util from '../../lib/util';
    export default {
        created: function () {
            this.$http.get('category/all').then(function (response) {
                let data = response.data;
                this.categories = data.data.list;
            });

            if (this.$route.params.id) {
                let self = this;
                this.$http.get('article/' + this.$route.params.id).then(function (response) {
                    self.data.title = response.data.data.title;
                    self.image.$set(0, response.data.data.gallery);
                    self.data.content = response.data.data.content;
                    self.data.category_id = response.data.data.category_id;
                    self.data.summary = response.data.data.summary;
                })
            }
        },
        data: function () {
            return {
                categories: [],
                image: [],
                data: {
                    title: '',
                    image: '',
                    content: '',
                    category_id: '',
                    summary: ''
                },
                editor: {
                    blur: undefined
                },
                isUpdate: this.$route.params.id
            }
        },
        methods: {
            submit: function () {
                let self = this;
                this.data.image = this.image[0];
                this.$validate(function () {
                    self.editor.blur = true;
                    if (self.$vld.valid && self.data.content) {
                        if (self.isUpdate) {
                            self.$http.put('article/' + self.$route.params.id, self.data).then(function (response) {
                                Util.successAndRedirect(self, '/article', '更新成功');
                            })
                        } else {
                            self.$http.post('article', self.data).then(function (response) {
                                Util.successAndRedirect(self, '/article');
                            })
                        }
                    }
                })
            },
            editorBlur: function (blur) {
                this.editor.blur = blur;
            },
            uploadSuccess: function (response, file) {
                this.image.$set(0, response.data.img_url);
            },
            deleteImage: function (image, index) {
                this.image.$remove(0);
            }
        },
        route: {
            canReuse: false
        },
        components: {
            editor: Editor,
            validationError: ValidationError,
            uploadImage: UploadImage,
        }
    }
</script>