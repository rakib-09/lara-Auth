<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
Here is the Routes for Laravel Auth. All the same as Laravel typical Auth.
We just update a little bit.
|
*/

    Route::get('/register', 'Authentication\\AuthController@getRegisterForm')->name('register');
    Route::post('/register', 'Authentication\\AuthController@registration')->name('register');

    Route::get('/login', 'Authentication\\AuthController@getLoginList')->name('login');
    Route::post('/login', 'Authentication\\AuthController@login')->name('login');

    Route::get('/user/login', 'Authentication\\AuthController@getLoginForm')->name('user.login');

    Route::post('/logout', 'Authentication\\AuthController@logout')->name('logout');

    Route::get('/password/forget', 'Authentication\\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'Authentication\\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'Authentication\\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/update', 'Authentication\\ResetPasswordController@reset')->name('password.update');

    Route::get('/home', 'HomeController@index')->name('home');


