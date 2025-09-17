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

Route::get('/', 'App\Http\Controllers\LoginController@index');
Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login');
Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

Route::get('/signup', 'App\Http\Controllers\SignupController@index')->name('signup');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->middleware('auth');
Route::get('/profile', 'App\Http\Controllers\HomeController@profile')->middleware('auth');


Route::prefix('projects')->group(function () {
    Route::get('/', 'App\Http\Controllers\ProjectsController@index')->middleware('auth');
    Route::get('/{id}/work', 'App\Http\Controllers\ProjectsController@project_work')->middleware('auth');
    Route::get('/{id}/summary', 'App\Http\Controllers\ProjectsController@project_summary')->middleware('auth');
    Route::get('/{id}/reports', 'App\Http\Controllers\ProjectsController@project_report')->middleware('auth');
    Route::get('/{id}/issues', 'App\Http\Controllers\ProjectsController@project_issues')->middleware('auth');
    Route::get('/{id}/issues/details/{issueId}', 'App\Http\Controllers\TasksController@get')->middleware('auth');
});


Route::prefix('issues')->group(function () {
    Route::get('/create', 'App\Http\Controllers\TasksController@create')->middleware('auth');
});


Route::prefix('sprints')->group(function () {
    Route::get('/', 'App\Http\Controllers\SprintsController@index')->middleware('auth');
});



// Route::get('/tasks', 'App\Http\Controllers\TasksController@index')->middleware('auth');

// Route::get('/my-tasks', 'App\Http\Controllers\TasksController@display_my_tasks')->middleware('auth');
// Route::get('/my-tasks/details/{id}', 'App\Http\Controllers\TasksController@display_my_task_details')->middleware('auth');

Route::middleware(['auth', 'admin.only'])->group(function () {
    Route::get('/admin', 'App\Http\Controllers\AdminController@index');
    Route::get('/admin/users', 'App\Http\Controllers\AdminController@users');
    Route::get('/admin/users/create', 'App\Http\Controllers\AdminController@create');

    Route::get('/admin/projects', 'App\Http\Controllers\ProjectsController@admin_projects')->middleware('auth');
    Route::get('/admin/projects/details/{id}', 'App\Http\Controllers\ProjectsController@get')->middleware('auth');
    Route::get('/admin/projects/user-mapping/{id}', 'App\Http\Controllers\ProjectsController@user_mapping')->middleware('auth');
    Route::get('/admin/projects/create', 'App\Http\Controllers\ProjectsController@create');
});

Route::post('/quill/image-upload', 'App\Http\Controllers\QuillUploadController@upload')->middleware('auth')->name('quill.image.upload');

//API
Route::get('/my-tasks/top-five', 'App\Http\Controllers\TasksApiController@get_my_top_tasks');
Route::get('/my-tasks/all', 'App\Http\Controllers\TasksApiController@get_all_my_tasks');
Route::get('/my-tasks/filter', 'App\Http\Controllers\TasksApiController@filter_my_tasks');
Route::get('/my-tasks/get-all-projects', 'App\Http\Controllers\TasksApiController@get_projects');


