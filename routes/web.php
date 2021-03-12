<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/upload', 'UploadController@store')->name('uploadMedia');
Route::delete('/upload', 'UploadController@delete')->name('deleteMedia');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {

    Route::get('/', 'AdminController@index');
    Route::resource('/roles', 'RolesController');
    Route::resource('/permissions', 'PermissionsController');
    Route::resource('/users', 'UsersController');
    Route::resource('/pages', 'PagesController');
    Route::resource('/activitylogs', 'ActivityLogsController')->only([
        'index', 'show', 'destroy'
    ]);
    Route::resource('/settings', 'SettingsController');
    Route::get('/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

    Route::resource('/courses', 'CoursesController');
    Route::resource('/quizzes', 'QuizzesController');

    Route::resource('/quizzes/{id}/questions', 'QuestionsController');

    Route::resource('/quizzes/{id}/questions/{question}/options', 'OptionsController');
});
