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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return redirect()->route('home');
});


Route::post('/upload', 'UploadController@store')->name('uploadMedia');
Route::delete('/upload', 'UploadController@delete')->name('deleteMedia');

Route::get('/quizzes', 'QuizzesController@index')->name('quizzes');
Route::get('/quizzes/{id}/{slug}', 'QuizzesController@viewQuiz')->name('viewQuiz');
Route::get('/quiz/attempt/{id}/{slug}', 'QuizzesController@attemptQuiz')->name('attemptQuiz')->middleware('auth');

Route::get('/toppers', 'ToppersController@index')->name('toppers');
Route::get('/about', 'HomeController@about')->name('about');

Route::get('/profile', 'ProfileController@index')->name('profileView');
Route::post('/profile', 'ProfileController@update')->name('profileUpdate');
Route::post('/change-password', 'ProfileController@changePasword')->name('changePassword');

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

Route::resource('admin/categories', 'Admin\CategoriesController');
Route::resource('admin/posts', 'Admin\PostsController');
