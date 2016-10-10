<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' =>['web']],function() {

        // Authentication Routes
           Route::get('auth/login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
           Route::post('auth/login','Auth\LoginController@login');
           Route::get('auth/logout', [ 'as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

       //Registration Routes
           Route::get('auth/register','Auth\RegisterController@showRegistrationForm');
           Route::post('auth/register','Auth\RegisterController@register');


       // Password Reset Routes

            Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm');
            Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail');
           Route::get('password/reset/{token?}','Auth\ResetPasswordController@showResetForm');
           Route::post('password/reset','Auth\ResetPasswordController@reset');

            Route::get('blog/{slug}', ['as' =>'blog.single','uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
    
            Route::get('blog',['uses' =>'BlogController@getIndex', 'as' => 'blog.index']);
    
            Route::get('contact', 'PagesController@getContact');
    
            Route::get('about','PagesController@getAbout');
    
            Route::get('/', 'PagesController@getIndex');
    
            Route::resource('posts', 'PostController');

});