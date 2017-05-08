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

Route::get('/', function () {
    return redirect()->route('admin.dashboard.index');
});

Route::get('/search', 'Admin\RealLibraries\RealLibraryController@search')->name('admin.library.search');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('', function () {
        return redirect()->route('admin.dashboard.index');
    });


    Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'middleware' => 'guest'], function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('admin.auth.login');
        Route::post('/login', 'LoginController@login')->name('admin.auth.login');
    });

    /*
     * Protected Routes
     */
    Route::group(['middleware' => 'auth'], function () {
        Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {
            Route::get('', 'DashboardController@index')->name('admin.dashboard.index');
        });

        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
            Route::get('logout', 'LoginController@logout')->name('admin.auth.logout');
        });

        Route::group(['prefix' => 'books', 'namespace' => 'Books'], function () {
            Route::get('', 'BooksController@index')->name('admin.books.index');
            Route::get('/create','BooksController@create')->name('admin.books.create');
            Route::post('/create', 'BooksController@store')->name('admin.books.create');
        });

        Route::group(['prefix' => 'libraries', 'namespace' => 'RealLibraries'], function () {
            Route::get('', 'RealLibraryController@index')->name('admin.libraries.index');
            Route::get('/create', 'RealLibraryController@create')->name('admin.libraries.create');
            Route::get('/store','RealLibraryController@search')->name('admin.libraries.search');
            Route::post('/store', 'RealLibraryController@store')->name('admin.libraries.store');
            Route::post('/test', 'RealLibraryController@test')->name('admin.libraries.test');
        });

        Route::group(['prefix' => 'admins', 'namespace' => 'Admins'], function () {
            Route::get('', 'AdminsController@index')->name('admin.admins.index');
            Route::get('/create', 'AdminsController@create')->name('admin.admins.create');
            Route::post('/store', 'AdminsController@store')->name('admin.admins.store');
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', 'AdminsController@edit')->name('admin.admins.edit');
                Route::post('/update', 'AdminsController@update')->name('admin.admins.update');
                Route::get('/delete', 'AdminsController@destroy')->name('admin.admins.delete');
            });
        });
    });

});
