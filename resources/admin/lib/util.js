export default {
    
    successAndRedirect (context, url = '', msg = '添加成功') {
        swal({
            title: msg,
            type: 'success',
            timer: 1700
        }).then(function () {
            if (url != '') {
                context.$route.router.go(url);
            }
        }).done();
        window.setTimeout(function () {
            swal.close();
            if (url != '') {
                context.$route.router.go(url);
            }
        }, 1700);
    }
}