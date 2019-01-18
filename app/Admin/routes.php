<?php

use Illuminate\Routing\Router;

//Admin::registerAuthRoutes();

Route::group([
    'domain'        => 'admin',
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->resource('article','ArticleController');
    $router->resource('label','LabelsController');
    $router->resource('category','CategoryController');
    $router->resource('comment','CommentController');
});
