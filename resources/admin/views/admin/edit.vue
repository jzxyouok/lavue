<template>
    <form class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label">名称：</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" v-model="user.username"
                       :disabled="user.id">
                <label class="help-block error" v-if="errors">{{errors['email']}}</label>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">旧密码：</label>

            <div class="col-sm-10">
                <input type="password" class="form-control" v-model="user.password">
                <label class="help-block error" v-if="errors">{{errors['password']}}</label>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">新密码：</label>

            <div class="col-sm-10">
                <input type="password" class="form-control" v-model="user.new_password">
                <label class="help-block error" v-if="errors">{{errors['new_password']}}</label>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button type="submit" class="btn btn-primary"  @click.prevent="submit">提交</button>
                <!--<a v-link="{name:'admin_index'}" class="btn btn-white">取消</a>-->
            </div>
        </div>
    </form>
</template>

<script>
    import Util from '../../lib/util';

    export default {
        created: function () {
            if (this.$route.params.id) {
                let self = this;
                this.$http.get('admin/' + this.$route.params.id).then(function (response) {
                    self.user = response.data.data;
                })
            }
        },
        data: function () {
            return {
                user: {}
            }
        },
        methods: {
            submit: function () {
                if (this.$route.params.id) {
                    this.$http.put('admin/' + this.$route.params.id, this.user).then(function () {
                        Util.successAndRedirect(self, '', '更新成功');
                    })
                } else {
                    this.$http.post('admin', this.user).then(function () {
                        Util.successAndRedirect(self, '', '添加成功');
                    })
                }
            }
        }
    }
</script>