<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;

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

Route::view('login', 'login');

Route::view('users', 'user.index')->name('users');

Route::view('students', 'student.index')->name('students');;

Route::resource('users', UserController::class)->only('edit', 'create');

Route::resource('students', StudentController::class)->only( 'edit', 'create');

Route::resource('photos.comments', Controller::class)->shallow ();

