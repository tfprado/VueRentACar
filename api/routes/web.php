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

// use App\Services\Twitter;

// Route::get('/', function (Twitter $twitter) {
//     dd($twitter);

//     return view('welcome');
// });
Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/**
 * GET /projects (index)
 * POST /projects (store)
 * GET /projects/create (create)
 * Get /projects/1/edit (show)
 * PATCH /projects/1 (update)
 * DELETE /projects/1 (destroy)
 */
// Route::get('/projects', 'ProjectsController@index');
// Route::get('/projects/create', 'ProjectsController@create');
// Route::get('/projects/{project}', 'ProjectsController@show');
// Route::post('/projects', 'ProjectsController@store');
// Route::get('/projects/{project}/edit', 'ProjectsController@edit');
// Route::patch('/projects/{project}', 'ProjectsController@update');
// Route::delete('/projects/{project}', 'ProjectsController@destroy');
Route::resource('/projects', 'ProjectsController');   // Same as the above lines

Route::post('projects/{project}/tasks', 'ProjectTasksController@store');    // To add middleware here instead of in a controller
Route::post('/completed-tasks/{task}', 'CompletedTasksController@store');   // ->middleware('auth')
Route::delete('/completed-tasks/{task}', 'CompletedTasksController@destroy');

Route::get('/test-ldap', function () {
    return view('ldap');
});
