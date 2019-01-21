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

Route::get('/scheduler', function () {
    return view('scheduler');
});

Route::get('/', 'PagesController@home'); //->middleware('can:update,project'); to authenticate if user can see a project here on the route file

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
Route::resource('/projects', 'Projects\ProjectsController');   // Same as the above lines

Route::post('projects/{project}/tasks', 'Projects\ProjectTasksController@store');    // To add middleware here instead of in a controller
Route::post('/completed-tasks/{task}', 'Projects\CompletedTasksController@store');   // ->middleware('auth')
Route::delete('/completed-tasks/{task}', 'Projects\CompletedTasksController@destroy');

// Route::get('/test-ldap', function () {
//     return view('ldap');
// });

Route::get('/test-ldap', 'LdapController@index');
Route::post('/ldap-login', 'LdapController@login');

/**
 * Kensington Registration and Sessions
 */
Route::get('/register-kensington', 'KensingtonAuth\RegistrationController@create');
Route::post('/register-kensington', 'KensingtonAuth\RegistrationController@store');

Route::get('/login-kensington', 'KensingtonAuth\SessionsController@create')->name('login-kensington');
Route::post('/login-kensington', 'KensingtonAuth\SessionsController@store');
Route::get('/logout-kensington', 'KensingtonAuth\SessionsController@destroy');

// Route::post('/login-kensington-local', 'KensingtonAuth\SessionsController@searchAd');
Route::post('/login-kensington-local', 'KensingtonAuth\SessionsController@getDbUser');
Route::post('/login-type', 'KensingtonAuth\SessionsController@setLoginType');

