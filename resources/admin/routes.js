export default function routeMap(router) {
    router.map({
        '/login': {
            'name': 'login',
            component: require('./views/login.vue')
        },
        '/': {
            name: '/',
            component: require('./views/layout.vue'),
            auth: true,
            subRoutes: {
                '/article': {
                    name: 'article',
                    component: require('./views/article/index.vue'),
                    auth: true
                },
                '/article/edit': {
                    name: 'article_edit',
                    component: require('./views/article/edit.vue'),
                    auth: true
                },
                '/article/edit/:id': {
                    name: 'article_update',
                    component: require('./views/article/edit.vue'),
                    auth: true
                },
                '/category': {
                    name: 'category',
                    component: require('./views/category/index.vue'),
                    auth: true
                },
                '/category/edit': {
                    name: 'category_edit',
                    component: require('./views/category/edit.vue'),
                    auth: true
                },
                '/category/edit/:id': {
                    name: 'category_update',
                    component: require('./views/category/edit.vue'),
                    auth: true
                }
            }
        }
    });
}

