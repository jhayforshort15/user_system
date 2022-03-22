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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('App\Http\Controllers')->middleware(['auth'])->group(function() {
    // Users
    Route::get('/users', 'UsersController@index')->name('users.index');

    // Roles
    Route::get('/roles', 'RolesController@index')->name('roles.index');
});

Route::prefix('api')->name('api')->namespace('App\Http\Controllers\API')->middleware(['auth'])->group(function () {
    Route::get('roles/list', 'RolesController@list')->name('roles.list');
    Route::post('roles/create', 'RolesController@createRoles')->name('roles.createRoles');
    Route::delete('roles/{id}', 'RolesController@delete')->name('roles.delete');
    Route::put('roles/{id}', 'RolesController@update')->name('roles.update');

    Route::get('users/list', 'UsersController@list')->name('users.list');
    Route::post('users/create', 'UsersController@createUser')->name('users.create');
    Route::delete('users/{id}', 'UsersController@delete')->name('users.delete');
    Route::put('users/{id}', 'UsersController@update')->name('users.update');
});
