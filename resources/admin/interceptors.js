export default function (router) {
    router.beforeEach(function (transition) {
        // 需要认证接口
        if (transition.to.auth) {
            if (!Auth.authenticated) {
                router.go(Auth.LOGIN_ROUTE);
            }
        }

        return true;
    });

    Vue.http.interceptors.push((request, next) => {
        next((response) => {
            if (response.data.data == undefined) {
                swal({
                    title: '获取数据失败，请稍后再试~',
                    type: 'error',
                    padding: 10,
                    timer: 1700
                }).done();

                /**
                 * TODO 由于下面以直接抛出异常的方式来终止页面继续往下执行，
                 * 导致app.vue中定义的拦截器无法正常，因此在此隐藏loading，之后再进行优化
                 */
                router.app.showLoading = false;

                // 直接抛出错误停止向下运行
                throw new Error('获取服务器数据失败，请稍后再试~');
            } else if (response.status == 401) {
                // token过期返回登录页面
                localStorage.removeItem(Auth.storageKey);
                Auth.authenticated = false;
                let msg = response.data.msg || '验证失败，请重新登录';
                swal({
                    title: msg,
                    type: 'error',
                    padding: 10,
                    timer: 1700
                }).then(function () {
                    router.go(Auth.LOGIN_ROUTE);
                });
                setTimeout(function () {
                    swal.close();
                    router.go(Auth.LOGIN_ROUTE);
                }, 1500);
            }else if (response.status != 200) {
                /**
                 * 是否在请求失败时自动错误提示框，
                 * 如不需要，在请求时设置custom对象的defaultDl为false值即可
                 */
                if ((!request.custom || request.custom.defaultDl) && response.data.msg) {
                    swal({
                        title: response.data.msg,
                        type: 'error',
                        padding: 10,
                        timer: 1700
                    }).done()
                    response.data.hadShow = false;
                }
            }
        });
    });
}