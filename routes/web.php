<?php

use App\Http\Controllers\Auth\LoginController;
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
    return redirect()->route('login');
});

Auth::routes();

Route::post('superadmin/login', [App\Http\Controllers\Auth\LoginController::class, 'superAdminLogin'])->name('superAdmin.login-redirect');
Route::post('admins/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admins.login-redirect');
//Route::get('user/login', [App\Http\Controllers\Auth\LoginController::class, 'userLogin'])->name('user.login-redirect');

Route::group(['prefix' => 'superadmin', 'middleware' => 'auth:superAdmin'], function () {
    Route::get('/login', [LoginController::class, 'showSuperAdminLoginForm'])->name('superAdmin.login');
    Route::get('home', [\App\Http\Controllers\SuperAdmin\SuperAdminController::class, 'index'])->name('superAdmin.home');
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::group(['prefix' => 'admins', 'middleware' => 'auth:admins'], function () {
    Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('admins.login');
    Route::get('home', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admins.home');
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:superAdmin'], function () {
    Route::get('/login', [LoginController::class, 'showStudentLoginForm'])->name('student.login');
    Route::get('home', [\App\Http\Controllers\Student\StudentController::class, 'index'])->name('student.home');
    Route::get('/logout', [LoginController::class, 'logout']);
});

