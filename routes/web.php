<?php

Auth::routes();

Route::group(['middleware' => 'guest'], function () {
    Route::get('admin', function () {
        return Redirect::to('/admin/login');
    });
    Route::get('admin/login', array('uses' => 'AdminController@getLogin'));
    Route::post('admin/login', array('uses' => 'AdminController@postLogin'));
    Route::get('admin/error403', function () {
        return view('errors.admin403');
    });
    Route::get('error403', function () {
        return view('errors.user403');
    });
    Route::get('/login',array('uses' => 'AuthController@loginPage','as' => 'login'));
    Route::post('/login',array('uses' => 'AuthController@postLogin'));
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'roles:1'], function () {
        Route::get('admin/dashboard', array('uses' => 'AdminController@getDashboard'));
        Route::get('admin/adduser', array('uses' => 'AdminController@addUser'));
        Route::post('admin/adduser', array('uses' => 'AdminController@addUser'));
        Route::get('admin/edituser/{userId?}', array('uses' => 'AdminController@editUser'));
        Route::post('admin/edituser/{userId?}', array('uses' => 'AdminController@editUser'));
        Route::post('admin/deleteuser', array('uses' => 'AdminController@deleteUser'));

        Route::get('admin/buslist', array('uses' => 'AdminController@busList'));
        Route::get('admin/addbus', array('uses' => 'AdminController@addBus'));
        Route::post('admin/addbus', array('uses' => 'AdminController@addBus'));
        Route::get('admin/editbus/{busId?}', array('uses' => 'AdminController@editBus'));
        Route::post('admin/editbus/{busId?}', array('uses' => 'AdminController@editBus'));
        Route::post('admin/deletebus', array('uses' => 'AdminController@deleteBus'));
    });

    Route::group(['middleware' => 'roles:2'], function () {
        Route::get('/', array('uses' => 'HomeController@searchBus'));
        Route::get('/searchbus', array('uses' => 'HomeController@searchBus'));
        Route::post('/searchbus', array('uses' => 'HomeController@searchBus'));
        Route::get('/autocomplete',array('uses' => 'HomeController@autocompleteLocation'));
        Route::get('/logout',array('uses' => 'HomeController@getLogout'));
    });

});
