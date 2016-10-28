require('sweetalert2');

let Auth = {
    SERVER_LOGIN_URL: 'login',

    LOGIN_ROUTE: '/login',

    INDEX_ROUTE: '/',

    storageKey: 'userData',

    // token有效时间21600秒
    tokenDuration: 21600,

    userData: null,

    authenticated: false,

    login(context, secret) {
        context.$http.post(this.SERVER_LOGIN_URL, secret, {custom:{defaultDl: true}}).then(data => {
            data = data.data.data;
            this.userData = {
                token: data.token,
                userId: data.id,
                username: data.username,
                expire: parseInt((new Date()).getTime() / 1000) + this.tokenDuration
            };
            localStorage.setItem(this.storageKey, JSON.stringify(this.userData));
            // 添加header认证
            let header = this.getAuthHeader();
            Vue.http.headers.common[header.key] = header.value;

            this.authenticated = true;

            let that = this;
            swal({
                type: 'success',
                title: '登录成功',
                showLoaderOnConfirm: true,
                allowOutsideClick: false
            }).then(function () {
                context.$route.router.go(that.INDEX_ROUTE);
            });
            setTimeout(function () {
                swal.close();
                context.$route.router.go(that.INDEX_ROUTE);
            }, 1500);
        }).catch((data) => {
            if (!data.hadShow) {
                swal({
                    title: data.data.msg || '登录失败,请稍后再试',
                    type: 'error',
                    padding: 10,
                    timer: 1700
                }).done();
            }
        });
    },

    logout(context) {
        localStorage.removeItem(this.storageKey);
        this.userData = null;
        this.authenticated = false;
        context.$route.router.go(this.LOGIN_ROUTE);
    },

    getUser() {
        if (!this.userData) {
            this.userData = JSON.parse(localStorage.getItem(this.storageKey));
        }

        if (this.userData && this.userData.token
            && this.userData.expire > parseInt((new Date()).getTime() / 1000)) {
            this.authenticated = true;
        } else {
            this.userData = null;
            localStorage.removeItem(this.storageKey);
        }

        this.getUser = () => {
            return this.userData;
        }

        return this.getUser();
    },

    getAuthHeader() {
        return {
            key: 'Authorization',
            value: 'Bearer ' + this.userData.token
        }
    }

};

Object.defineProperty(Auth, 'SERVER_LOGIN_URL',
    {
        configurable: false,
        writable: false
    }
);
Object.defineProperty(Auth, 'LOGIN_ROUTE',
    {
        configurable: false,
        writable: false
    }
);
Object.defineProperty(Auth, 'INDEX_ROUTE',
    {
        configurable: false,
        writable: false
    }
);
Object.defineProperty(Auth, 'storageKey',
    {
        configurable: false,
        writable: false
    }
);

export default Auth;