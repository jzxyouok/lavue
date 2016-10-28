<template>
    <div>

        <data-table :data="list" :columns="columns"></data-table>

        <pagination :count="count" :page="page" :page-size="pageSize" :get-data="getData"></pagination>

    </div>
</template>

<script>
    import DataTable from '../../components/data-table.vue';
    import Pagination from '../../components/pagination.vue';
    export default{
        created: function () {
            this.getData(this.page, this.pageSize);
        },
        data: function () {
            return {
                list: [],
                url: 'category',
                page: 1,
                pageSize: 10,
                count: 0,

                columns: [
                    {
                        field: 'id',
                        title: '#'
                    },
                    {
                        field: 'name',
                        title: '名称'
                    },
                    {
                        field: 'created_at',
                        title: '创建时间'
                    }
                ],
            }
        },
        methods: {
            getData: function (page, pageSize) {
                this.$http.get(this.url, {params:{page:page,page_size:pageSize}}).then(function (response) {
                    let data = response.data;
                    this.list = data.data.list;
                    this.count = data.data.count;
                });
            },
            delete: function (item) {
                var vm = this;
                swal({
                    title: '分类下文章也会被删除，确定删除吗~?！',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: '确定',
                    cancelButtonText: '取消'
                }).then(function() {
                    vm.$http.delete(vm.url + '/' + item.id).then(
                            function (response) {
                                swal({
                                    title: '删除成功~！',
                                    type: 'success',
                                    timer: 1200
                                })
                                this.list.$remove(item);
                            }, function (response) {
                                swal({
                                    title: response.data.msg,
                                    type: 'error',
                                    timer: 2000
                                });
                            }
                    )
                })
            },
            edit: function (item) {
                this.$route.router.go({name: 'category_update', params: {id:item.id}});
            }
        },
        components: {
            pagination: Pagination,
            dataTable: DataTable,
        },
        events: {
            delete: function (item) {
                this.delete(item);
            },
            edit: function (item) {
                this.edit(item);
            }
        }
    }
</script>