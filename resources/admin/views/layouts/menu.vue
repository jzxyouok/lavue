<style>
    .main-sidebar {
        background-color: #2F4050;
        padding-top: 20px;
    }

    .user-panel {
        height: 75px;
        text-align: center;
        margin: 0;
    }

    .user-panel > li {
        display: block;
        float: none !important;
        color: #A7B1C2;
    }

    .user-panel > li.info {
        margin-top: 7px;
        padding: 0;
        position: static;
    }

    .nav-tabs {
        border-bottom: 0;
        margin-top: 5px;
    }

    .treeview-menu li a {
        text-align: center;
    }

    .sidebar-menu > li.active > a, .sidebar-menu > li > a, .sidebar-menu > li > ul {
        background-color: #2F4050 !important;
    }

    .sidebar-mini.sidebar-collapse .sidebar-menu > li:hover > a > span {
        margin: 0;
        padding: 12px 5px 14px 20px
    }

    .nav-tabs > li > a {
        padding-left: 15px;
    }

    .sidebar-mini.sidebar-collapse .sidebar-menu>li:hover>a>.pull-right-container {
        top: 4px !important;
    }
</style>
<template>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="user-panel">
                <li class="pull-left image">
                    <img src="../../assets/images/avatar.jpg" class="img-circle" alt="User Image">
                </li>
                <li class="pull-left info">
                    <p class="">
                        <strong>{{ username }}</strong>
                    </p>
                </li>
            </ul>
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li><a href="#">个人资料</a></li>
                    <li class="divider"></li>
                    <li><a @click="logout">退出</a></li>
                </ul>
            </div>

            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i>
                        <span>文章管理</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a v-link="{name:'article'}">文章列表</a></li>
                        <li><a v-link="{name:'article_edit'}">文章添加</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>分类管理</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a v-link="{name:'category'}">分类列表</a></li>
                        <li><a v-link="{name:'category_edit'}">添加分类</a></li>
                    </ul>
                </li>
                <!--<li>-->
                    <!--<a href="../widgets.html">-->
                        <!--<i class="fa fa-th"></i> <span>Widgets</span>-->
                <!--<span class="pull-right-container">-->
                  <!--<small class="label pull-right bg-green">new</small>-->
                <!--</span>-->
                    <!--</a>-->
                <!--</li>-->
                <!--<li class="treeview">-->
                    <!--<a href="#">-->
                        <!--<i class="fa fa-pie-chart"></i>-->
                        <!--<span>Charts</span>-->
                <!--<span class="pull-right-container">-->
                  <!--<i class="fa fa-angle-left pull-right"></i>-->
                <!--</span>-->
                    <!--</a>-->
                    <!--<ul class="treeview-menu">-->
                        <!--<li><a href="../charts/chartjs.html">ChartJS</a></li>-->
                        <!--<li><a href="../charts/morris.html">Morris</a></li>-->
                        <!--<li><a href="../charts/flot.html">Flot</a></li>-->
                        <!--<li><a href="../charts/inline.html">Inline charts</a></li>-->
                    <!--</ul>-->
                <!--</li>-->

                <!--<li class="treeview">-->
                    <!--<a href="#">-->
                        <!--<i class="fa fa-share"></i> <span>Multilevel</span>-->
                <!--<span class="pull-right-container">-->
                  <!--<i class="fa fa-angle-left pull-right"></i>-->
                <!--</span>-->
                    <!--</a>-->
                    <!--<ul class="treeview-menu">-->
                        <!--<li><a href="#">Level One</a></li>-->
                        <!--<li>-->
                            <!--<a href="#">Level One-->
                    <!--<span class="pull-right-container">-->
                      <!--<i class="fa fa-angle-left pull-right"></i>-->
                    <!--</span>-->
                            <!--</a>-->
                            <!--<ul class="treeview-menu">-->
                                <!--<li><a href="#">Level Two</a></li>-->
                                <!--<li>-->
                                    <!--<a href="#">Level Two-->
                        <!--<span class="pull-right-container">-->
                          <!--<i class="fa fa-angle-left pull-right"></i>-->
                        <!--</span>-->
                                    <!--</a>-->
                                    <!--<ul class="treeview-menu">-->
                                        <!--<li><a href="#">Level Three</a></li>-->
                                        <!--<li><a href="#">Level Three</a></li>-->
                                    <!--</ul>-->
                                <!--</li>-->
                            <!--</ul>-->
                        <!--</li>-->
                        <!--<li><a href="#">Level One</a></li>-->
                    <!--</ul>-->
                <!--</li>-->
            </ul>
        </section>
    </aside>
</template>
<script>
    export default {
        data: function () {
            return {
                username: Auth.getUser().username,
            }
        },
        methods: {
            logout: function () {
                Auth.logout(this);
            }
        }
    }
</script>