<style>
    .pagination > li.active > a,.pagination > li.active > a:hover{
        color: #fff;
        background-color: #3097D1;
        border-color: #3097D1;
    }
    .pagination > li > a{
        padding: 7px 15px;
    }
</style>

<template>

    <div class="row">
        <div class="col-lg-12">
            <div style="text-align: center">
                <ul class="pagination" v-if="isShow">
                    <li v-if="showFirst"><a @click.prevent="page--"><span>&laquo;</span></a></li>
                    <li v-for="index in pages" :class="{ 'active': page == index}">
                        <a @click.prevent="linkClick(index)">{{ index }}</a>
                    </li>
                    <li v-if="showLast"><a @click.prevent="page++"><span>&raquo;</span></a></li>
                </ul>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            page: {
                type: Number,
                required: true
            },
            showSize: {
                type: Number,
                default: 10
            },
            pageSize: {
                type: Number,
                required: true
            },
            count: {
                type: Number,
                required: true
            },
            getData: {
                type: Function,
                required: true
            }
        },
        computed: {
            isShow: function () {
                return Math.floor(this.count / this.pageSize);
            },
            pages: function () {
                var arr = [],
                        left = 1,
                        totalPage = Math.ceil(this.count / this.pageSize),
                        right = totalPage;
                if (this.showSize > totalPage) {
                    this.showSize = totalPage;
                }

                if (this.page > totalPage) {
                    this.page = totalPage;
                }
                if (totalPage >= (this.showSize + 1)) {
                    let halfRight = Math.ceil((this.showSize - 1) / 2)
                    let halfLeft = Math.floor((this.showSize - 1) / 2)
                    if (this.page > halfRight && this.page < totalPage - halfLeft) {
                        left = this.page - halfRight;
                        right = this.page + halfLeft
                    } else {
                        if (this.page <= halfRight) {
                            left = 1
                            right = this.showSize
                        } else {
                            right = totalPage
                            left = totalPage - (this.showSize - 1)
                        }
                    }
                }
                while (left <= right) {
                    arr.push(left)
                    left++
                }
                return arr
            },
            showLast: function () {
                return !(this.page == Math.ceil(this.count / this.pageSize));
            },
            showFirst: function () {
                return !(this.page == 1);
            }
        },
        methods: {
            linkClick: function (index) {
                if (index != this.page) {
                    this.page = index
                }
            }
        },
        watch: {
            page: function (oldValue, newValue) {
                this.getData(this.page, this.pageSize);
            }
        }
    }

</script>
