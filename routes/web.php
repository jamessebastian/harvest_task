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
    return view('welcome');
});

Auth::routes();

Route::get('/clogin', 'CustomAuth.LoginController@showLoginForm');
Route::get('/clogin', 'CustomAuth.LoginController@showLoginForm');




Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//Route::resource('/admin/users','Admin\UsersController',['except'=>['show','create','store']]);

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users','UsersController',['except'=>['show','create','store']]);
});



Route::get('/clients', 'ClientsController@index');
Route::post('/clients', 'ClientsController@store');
Route::get('/clients/create', 'ClientsController@create');
Route::get('/clients/{client}/edit', 'ClientsController@edit');
Route::put('/clients/{client}', 'ClientsController@update');
//Route::delete('/clients/{client}', 'ClientsController@delete');
Route::delete('/clients/{client}', 'ClientsController@ajaxDelete');

Route::get('/tasks', 'TasksController@index');
Route::post('/tasks', 'TasksController@store');
Route::get('/tasks/{task}/edit', 'TasksController@edit');
Route::put('/tasks/{task}', 'TasksController@update');
//Route::delete('/tasks/{task}', 'TasksController@delete');
Route::delete('/tasks/{task}', 'TasksController@ajaxDelete');

Route::get('/expenses', 'ExpensesController@index');
Route::post('/expenses', 'ExpensesController@store');
Route::get('/expenses/{expense_id}', 'ExpensesController@edit');
Route::put('/expenses/{expense_id}', 'ExpensesController@update');
Route::delete('/expenses/{expense_id}', 'ExpensesController@delete');


Route::get('/team', 'PersonsController@index');
Route::post('/person', 'PersonsController@store');
Route::get('/person/new', 'PersonsController@create');
Route::delete('/person/{person_id}', 'PersonsController@delete');


Route::get('/projects', 'ProjectsController@index');
Route::post('/projects', 'ProjectsController@store');
Route::get('/projects/new', 'ProjectsController@create');

Route::get('/time', 'TimeEntryController@redirectToToday');
Route::get('/time/{year}/{month}/{day}', 'TimeEntryController@index');
Route::post('/time', 'TimeEntryController@store');
Route::delete('/timeEntry/{Time_entry_id}', 'TimeEntryController@delete');


Route::get('/approve', 'TimeSheetController@index');


Route::post('/test/{w}', 'TestController@test');
Route::get('/test', function (){
    return view('test');
});

//Route::get('ajax',function() {
//    return view('message');
//});
