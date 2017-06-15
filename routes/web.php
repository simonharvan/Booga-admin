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

Route::get('/search/{libraryId}/{query}', 'Admin\Books\BooksController@search')->name('admin.library.search');
Route::post('/test', 'Admin\RealLibraries\RealLibraryController@test')->name('admin.libraries.test');
Route::get('/load-cover', 'Admin\Books\BooksController@load')->name('admin.books.loadCover');


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
            Route::post('/create', 'BooksController@store')->name('admin.books.store');
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', 'BooksController@edit')->name('admin.books.edit');
                Route::post('/update', 'BooksController@update')->name('admin.books.update');
                Route::get('/delete', 'BooksController@destroy')->name('admin.books.delete');

                Route::group(['prefix' => 'identifytext', 'namespace' => 'IdentifyText'], function () {
                    Route::get('/create', 'IdentifyTextQuizController@create')->name('admin.identifyText.create');
                    Route::post('/create', 'IdentifyTextQuizController@store')->name('admin.identifyText.store');
                    Route::group(['prefix' => '{quizId}'], function () {
                        Route::get('/edit', 'IdentifyTextQuizController@edit')->name('admin.identifyText.edit');
                        Route::post('/edit', 'IdentifyTextQuizController@update')->name('admin.identifyText.update');
                        Route::get('/delete', 'IdentifyTextQuizController@destroy')->name('admin.identifyText.delete');
                    });
                });
                Route::group(['prefix' => 'miniquiz', 'namespace' => 'MiniQuiz'], function () {
                    Route::get('/create', 'MiniQuizController@create')->name('admin.miniQuiz.create');
                    Route::post('/create', 'MiniQuizController@store')->name('admin.miniQuiz.store');
                    Route::group(['prefix' => '{quizId}'], function () {
                        Route::get('/edit', 'MiniQuizController@edit')->name('admin.miniQuiz.edit');
                        Route::post('/edit', 'MiniQuizController@update')->name('admin.miniQuiz.update');
                        Route::get('/delete', 'MiniQuizController@destroy')->name('admin.miniQuiz.delete');
                    });
                });

                Route::group(['prefix' => 'identifycharacter', 'namespace' => 'IdentifyCharacter'], function () {
                    Route::get('/create', 'IdentifyCharacterQuizController@create')->name('admin.identifyCharacter.create');
                    Route::post('/create', 'IdentifyCharacterQuizController@store')->name('admin.identifyCharacter.store');
                    Route::group(['prefix' => '{quizId}'], function () {
                        Route::get('/edit', 'IdentifyCharacterQuizController@edit')->name('admin.identifyCharacter.edit');
                        Route::post('/edit', 'IdentifyCharacterQuizController@update')->name('admin.identifyCharacter.update');
                        Route::get('/delete', 'IdentifyCharacterQuizController@destroy')->name('admin.identifyCharacter.delete');
                    });
                });
            });

        });
        Route::group(['prefix' => 'quizzes', 'namespace' => 'Quizzes'], function () {
            Route::get('', 'QuizzesController@index')->name('admin.quizzes.index');
        });



        Route::group(['prefix' => 'libraries', 'namespace' => 'RealLibraries'], function () {
            Route::get('', 'RealLibraryController@index')->name('admin.libraries.index');
            Route::get('/create', 'RealLibraryController@create')->name('admin.libraries.create');
            Route::get('/store','RealLibraryController@search')->name('admin.libraries.search');
            Route::post('/store', 'RealLibraryController@store')->name('admin.libraries.store');
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', 'RealLibraryController@edit')->name('admin.libraries.edit');
                Route::post('/update', 'RealLibraryController@update')->name('admin.libraries.update');
                Route::get('/delete', 'RealLibraryController@destroy')->name('admin.libraries.delete');
            });
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

        Route::group(['prefix' => 'logs', 'namespace' => 'Logs'], function () {
           Route::get('', 'LogsController@index')->name('admin.logs.index');
        });

        Route::group(['prefix' => 'citations', 'namespace' => 'Citations'], function () {
            Route::get('', 'CitationsController@index')->name('admin.citations.index');
            Route::get('/create', 'CitationsController@create')->name('admin.citations.create');
            Route::post('/store', 'CitationsController@store')->name('admin.citations.store');
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', 'CitationsController@edit')->name('admin.citations.edit');
                Route::post('/update', 'CitationsController@update')->name('admin.citations.update');
                Route::get('/delete', 'CitationsController@destroy')->name('admin.citations.delete');
            });
        });

        Route::group(['prefix' => 'levels', 'namespace' => 'Levels'], function () {
            Route::get('', 'LevelsController@index')->name('admin.levels.index');
            Route::get('/create', 'LevelsController@create')->name('admin.levels.create');
            Route::post('/store', 'LevelsController@store')->name('admin.levels.store');
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', 'LevelsController@edit')->name('admin.levels.edit');
                Route::post('/update', 'LevelsController@update')->name('admin.levels.update');
                Route::get('/delete', 'LevelsController@destroy')->name('admin.levels.delete');
            });
        });

        Route::group(['prefix' => 'avatars', 'namespace' => 'Avatars'], function () {
            Route::get('', 'AvatarsController@index')->name('admin.avatars.index');
            Route::get('/create', 'AvatarsController@create')->name('admin.avatars.create');
            Route::post('/store', 'AvatarsController@store')->name('admin.avatars.store');
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', 'AvatarsController@edit')->name('admin.avatars.edit');
                Route::post('/update', 'AvatarsController@update')->name('admin.avatars.update');
                Route::get('/delete', 'AvatarsController@destroy')->name('admin.avatars.delete');
            });
        });

        Route::group(['prefix' => 'badges', 'namespace' => 'Badges'], function () {
            Route::get('', 'BadgesController@index')->name('admin.badges.index');
            Route::get('/create', 'BadgesController@create')->name('admin.badges.create');
            Route::post('/store', 'BadgesController@store')->name('admin.badges.store');
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', 'BadgesController@edit')->name('admin.badges.edit');
                Route::post('/update', 'BadgesController@update')->name('admin.badges.update');
                Route::get('/delete', 'BadgesController@destroy')->name('admin.badges.delete');
            });
        });

        Route::group(['prefix' => 'table-of-fame','namespace' => 'TableOfFame'], function () {
            Route::get('', 'TableOfFameController@index')->name('admin.tableOfFame.index');
        });

        Route::group(['prefix' => 'profile','namespace' => 'Profile'], function () {
            Route::get('/edit', 'ProfileController@edit')->name('admin.profile.edit');
            Route::get('/{id}/detail', 'ProfileController@detail')->name('admin.profile.detail');
        });
    });

});
