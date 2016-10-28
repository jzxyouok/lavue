<style>
    select>option:disabled {background-color: #ececec;}
</style>

<template>
    <form class="form-horizontal" @submit="submit">
        <div class="form-group">
            <label class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required v-model="data.name">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">父级分类：</label>
            <div class="col-sm-10">
                <select class="form-control" v-model="data.category_id">
                    <option value="0">请选择</option>
                    <option v-for="category in categories" :disabled="category.id==category_id" :value="category.id">{{ category.name }}</option>
                </select>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">提交</button>
                <a v-link="{name:'category'}" class="btn btn-danger">取消</a>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        created: function () {
            this.$http.get('category/all').then(function (response) {
                let data = response.data;
                this.categories = data.data.list;
            });

            if (this.$route.params.id != undefined) {
                this.$http.get('category/' + this.$route.params.id).then(function (response) {
                    let data = response.data;
                    this.data.name = data.data.name;
                    this.data.category_id = data.data.parent_id;
                    this.category_id = data.data.id;
                })
            }
        },
        data: function () {
            return {
                categories: [],
                category_id: 0,
                data: {
                    name: '',
                    category_id: 0
                }
            };
        },
        route: {
            canReuse: false
        },
        methods: {
            submit: function () {
                let vm = this;
                if (this.category_id > 0) {
                    this.$http.put('category/' + this.category_id, this.data).then(function (response) {
                        swal({type:'success',title:'修改成功',timer:1500}).then(function () {
                            vm.$route.router.go('/category');
                        }).done();
                        setTimeout(function () {
                            vm.$route.router.go('/category');
                        }, 1500);
                    });
                } else {
                    this.$http.post('category', this.data).then(function () {
                        swal({type:'success',title:'添加成功',timer:1500}).then(function () {
                            vm.$route.router.go('/category');
                        }).done();
                        setTimeout(function () {
                            swal.close();
                            vm.$route.router.go('/category');
                        }, 1500);
                    });
                }
                return false;
            }
        }
    }
</script>