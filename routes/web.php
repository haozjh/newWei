<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//用户模块
Route::get('/', function () {
   return redirect('/login');
});
//注册页面
Route::get('/register', 'RegisterController@index');
//注册行为
Route::post('/register', 'RegisterController@register');
//登录页面
Route::get('/login', 'LoginController@index')->name('login');
//登录行为
Route::post('/login', 'LoginController@login');

Route::group(['middleware' => 'auth:web'], function () {
    //登出行为
    Route::get('/logout', 'LoginController@logout');
    //个人设置页面
    Route::get('/user/me/setting', 'UserController@setting');
    //个人设置操作
    Route::post('/user/me/setting', 'UserController@settingStore');
    //文章列表页
    Route::get('/posts', 'PostController@index');
    //创建文章
    Route::get('/posts/create', 'PostController@create');
    Route::post('/posts', 'PostController@store');
    //文章详情页
    Route::get('/posts/{post}', 'PostController@show');
    //编辑文章
    Route::get('/posts/{post}/edit', 'PostController@edit');
    Route::put('/posts/{post}', 'PostController@update');
    //删除文章
    Route::get('/posts/{post}/delete', 'PostController@delete');
    //图片上传
    Route::post('/posts/image/upload', 'PostController@imageUpload');

});



