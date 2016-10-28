<style>
    .table .btn {margin-right: 4px;}
    .back {margin-left: -4px;}
    td > img {width: 120px;max-height: 120px;}
</style>

<template>
    <table class="table">
        <thead>
        <tr>
            <td v-for="v in columns">
                {{v.title}}
            </td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in data">
            <td v-for="v in columns">
                {{{typeof v.field=='function'?v.field(item):item[v.field]}}}
            </td>
            <td>
                <a :class="action.btnClass" class="btn btn-sm" @click.prevent="action.callback(item)"
                   v-for="action in customActions">{{typeof action.name == 'function'?action.name(item):action.name}}</a>
                <a :class="[k==0?'back':'',action.btnClass]" class="btn btn-sm" @click.prevent="invokeAction(action.key, item)"
                   v-for="(k,action) in actions">{{typeof action.name == 'function'?action.name(item):action.name}}</a>
            </td>
        </tr>
        </tbody>
    </table>
</template>
<script>
    export default {
        props: {
            columns: {
                required: true,
                type: Array
            },
            data: {
                required: true,
                type: Array
            },
            actions: {
                type: Array,
                default: function () {
                    return [
                        {
                            key: 'edit',
                            name: '编辑',
                            btnClass: 'btn-info'
                        },
                        {
                            key: 'delete',
                            name: '删除',
                            btnClass: 'btn-danger'
                        }
                    ]
                }
            },
            customActions: {
                type: Array
            }
        },
        methods: {
            invokeAction: function (action, item) {
                this.$dispatch(action, item);
            }
        }
    }
</script>