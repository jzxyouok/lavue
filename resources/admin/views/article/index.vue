<style type="text/css">
    .filter-container div{margin: 0 0 15px;}
    .filter-container div>input{margin: 0 20px 0 5px;}
    .table td {width: auto;}
    .pagination > li > a, .pagination > li > span {
        position: relative;
        float: left;
        padding: 6px 12px;
        line-height: 1.6;
        text-decoration: none;
        color: #3097D1;
        background-color: #fff;
        border: 1px solid #ddd;
        margin-left: -1px;
    }
    .pagination > li.active > span,.pagination > li.active > span:hover{
        z-index: 3;
        color: #fff;
        background-color: #3097D1;
        border-color: #3097D1;
        cursor: default;
    }
</style>

<template>
    <div>

        <data-table :data="list" :columns="columns" :custom-actions="customActions"></data-table>
        <pagination :count="count" :page="page" :page-size="pageSize" :get-data="getData"></pagination>

    </div>
</template>
<script type="text/javascript">
    import Pagination from '../../components/pagination.vue';
    import DataTable from '../../components/data-table.vue';
    export default {
        created:function() {

            this.getData(this.page, this.pageSize);
        },
        data: function () {
            return {
                url: 'article',
                list: [],
                page: 1,
                pageSize: 10,
                count: 0,

                columns: [
                    {
                        field: 'id',
                        title: '#'
                    },
                    {
                        field: 'title',
                        title: '标题'
                    },
                    {
                        field: function (item) {
                            return '<img class="img-thumbnail" src="' + item.gallery + '" >';
                        },
                        title: '预览图'
                    },
                    {
                        field: 'summary',
                        title: '摘要'
                    },
                    {
                        field: 'created_at',
                        title: '创建时间'
                    },
                    {
                        field: function (item) {
                            return item.category.name;
                        },
                        title: '分类'
                    },
                    {
                        field: function (item) {
                            return item.admin.username
                        },
                        title: '用户'
                    }
                ],

                customActions: [
                    {
                        key: 'edit',
                        name: function (item) {
                            return item.status ? '禁用' : '启用';
                        },
                        btnClass: 'btn-info',
                        callback: (item) => {
                            this.switchStatus(item);
                        }
                    }
                ]
            }
        },
        components: {
            pagination: Pagination,
            dataTable: DataTable,
        },
        methods:{
            getData: function (page, pageSize) {
                this.$http.get(this.url, {params:{page:page,page_size:pageSize}}).then(function (response) {
                    let data = response.data;
                    this.list = data.data.list;
                    this.count = data.data.count;
                });
            },
            switchStatus:function(item) {
                this.$http.put(this.url+'/switch/'+item.id).then(
                        function(response) {
                            swal({
                                title: '修改成功~！',
                                type: 'success',
                                timer: 1200
                            })
                            item.status = item.status ? 0 : 1;
                        },function(response) {
                            swal({
                                title: response.data.msg,
                                type: 'error',
                                timer: 2000
                            });
                        }
                )
            },
            edit:function(item) {
                this.$router.go('article/edit/' + item.id)
            },
            delete:function(item) {
                var vm = this;
                swal({
                    title: '删除数据将无法恢复，是否确定删除~?！',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: '确定',
                    cancelButtonText: '取消'
                }).then(function() {
                    vm.$http.delete(this.url + '/' + item.id).then(
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

            }
        },
        events: {
            delete: function (item) {
                this.delete(item)
            },
            edit: function (item) {
                this.edit(item)
            }
        }
    }
</script>