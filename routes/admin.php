<?php
//sleep(1);
//return response('test', 404);
/**
 * @var \Illuminate\Routing\Router $router
 */
$router->get('/', 'AuthController@index');
//$router->post('/login', 'AuthController@login');
$router->post('/login', 'AuthController@login');

$router->group(['middleware' => ['auth:admin']], function (\Illuminate\Contracts\Routing\Registrar $router) {
    $router->get('/logout', 'AuthController@logout');
    $router->get('/index', 'CommonController@index');

    $router->post('uploadImg', 'CommonController@uploadImg');

    $router->put('article/switch/{id}', 'ArticleController@switchStatus');
    $router->resource('article', 'ArticleController');
    
    $router->get('category/all', 'CategoryController@all');
    $router->resource('category', 'CategoryController');

    $router->resource('admin', 'AdminController');
});