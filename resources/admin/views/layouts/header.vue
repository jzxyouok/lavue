<style>
    .navbar-top-links li {
        display: inline-block;
    }
    .m-r-sm {
        margin-right: 10px;
    }
    .text-muted {
        color: #888888;
    }
    .navbar-top-links li:last-child {
        margin-right: 40px;
    }
    .nav.navbar-right > li > a {
        color: #999c9e;
    }
    .nav.navbar-top-links a {
        font-size: 14px;
    }
    .navbar-top-links li a {
        padding: 20px 10px;
        min-height: 50px;
    }
    .nav > li > a i {
        margin-right: 6px;
    }
    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        transform: translate(0, 0);
    }
    .toggle-btn {
        padding: 4px 12px !important;
        margin: 14px 5px 5px 20px;
        font-size: 14px;
        float: left;
        background-color: #1AB394 !important;
        border-color: #1AB394 !important;
    }
    .toggle-btn:hover {
        background-color: #1AB394 !important;
        border-color: #1AB394 !important;
    }
    .btn-logout {
        color: #888888 !important;
    }
    .btn-logout:hover {
        cursor: pointer;
    }
</style>

<template>
    <header class="main-header">

        <nav class="navbar navbar-static-top" style="background-color: #F3F3F4;">
            <!-- Sidebar toggle button-->
            <a type="button" class="btn btn-primary sidebar-toggle toggle-btn" data-toggle="offcanvas"></a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">欢迎您 {{ username }}！</span>
                    </li>
                    <li>
                        <a class="btn-logout" @click="logout">
                            <i class="fa fa-sign-out"></i> 退出
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
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