<?php

<<<<<<< HEAD
use App\Http\Controllers\PersonController;
use App\Http\Controllers\RoleController;
=======
>>>>>>> a3d4b43 (update laravel files on main)
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
<<<<<<< HEAD

Route::view('home', 'home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    //Route::resource('users', UserController::class);
    Route::resource('persons', PersonController::class);
});
=======
>>>>>>> a3d4b43 (update laravel files on main)
