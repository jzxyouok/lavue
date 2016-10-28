<style rel="stylesheet">
    .center {
        margin-left: auto !important;
        margin-right: auto !important;
        float: none !important;
        text-align: center;
    }

    .login-header {
        padding-top: 30px;
        height: 120px;
    }

    .login-btn {
        margin-top: 15px;
        width: 100%;
        background-image: -webkit-linear-gradient(#54b4eb, #2fa4e7 60%, #1d9ce5);
        background-image: linear-gradient(#54b4eb, #2fa4e7 60%, #1d9ce5);
        filter: none;
        border-color: #2fa4e7;
    }

    .loader {
        position: absolute;
        left: 50%;
        top: 50%;
        margin-left: -60px;
        margin-top: -12px;
    }

    .dot {
        float: left;
        margin: 0 8px;
        width: 24px;
        height: 24px;
        border-radius: 12px;
        background: black;
    }
</style>

<template>
    <div class="row" style="color: #317eac;">
        <div class="col-md-12 center login-header">
            <h2>Welcome.</h2>
        </div>
        <!--/span-->
    </div>
    <div class="row">
        <div class="col-md-5 center well">
            <div class="alert alert-info">
                Please login with your Username and Password.
            </div>
            <form class="form-horizontal" method="post" @submit.prevent="submit">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">帐号</span>
                        <input type="text" name="username" v-model="postData.username" required="" class="form-control"
                               placeholder="Username">
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">密码</span>
                        <input type="password" name="password" v-model="postData.password" required=""
                               class="form-control" placeholder="Password">
                    </div>
                    <div class="clearfix"></div>
                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary login-btn">Login</button>
                    </p>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        ready: function () {
            if (Auth.authenticated) {
                this.$route.router.go(Auth.INDEX_ROUTE);
            }
        },
        data: function () {
            return {
                postData: {
                    username: '',
                    password: ''
                }
            }
        },
        methods: {
            submit: function () {
                Auth.login(this, this.postData);
            }
        }
    }
</script>