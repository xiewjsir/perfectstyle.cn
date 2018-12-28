<?php

use Illuminate\Routing\Router;

Route::group(['middleware'=>['auth.admin']],function(Router $router){
    Router::any('/', 'IndexController@index')->name('admin.index');
    Router::any('user/list', 'UserController@list')->name('admin.user.list');
    Router::get('logout', 'LoginController@logout')->name('admin.logout');
    Router::resource('post','PostController');
    Router::resource('file','FileController');
    Router::resource('adminUser','AdminUserController');
    Router::resource('adminNode','adminNodeController');
    Router::resource('adminRole','adminRoleController');
    Router::resource('adminPermission','adminPermissionController');

    $router->any('file/upload', 'FileController@upload')->name('file.upload');
    $router->put('api/post/updateField', 'PostController@updateField')->name('api.post.updateField');
});

Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'LoginController@login');