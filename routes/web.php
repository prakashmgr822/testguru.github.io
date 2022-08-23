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

Route::get('/redirect-user', function () {
    if (\App\Helpers\GuardHelper::check() === "admins") {
        return redirect()->route('admins.home');
    } elseif(\App\Helpers\GuardHelper::check() === "superAdmin") {
        return redirect()->route('superAdmin.home');
    } else {
        return redirect()->route('student.home');
    }
})->name('redirect-user');

Route::post('superadmin/login', [App\Http\Controllers\Auth\LoginController::class, 'superAdminLogin'])->name('superAdmin.login-redirect');
Route::post('admins/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admins.login-redirect');
Route::post('user/login', [App\Http\Controllers\Auth\LoginController::class, 'userLogin'])->name('user.login-redirect');

Route::group(['prefix' => 'superadmin', 'middleware' => 'auth:superAdmin'], function () {
    Route::get('/login', [LoginController::class, 'showSuperAdminLoginForm'])->name('superAdmin.login');
    Route::get('/home', [\App\Http\Controllers\SuperAdmin\DashboardController::class, 'index'])->name('superAdmin.home');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::resource('admins', \App\Http\Controllers\SuperAdmin\AdminController::class);
});

Route::group(['prefix' => 'admins', 'middleware' => 'auth:admins'], function () {
    Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('admins.login');
    Route::get('home', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admins.home');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::resource('grades', \App\Http\Controllers\Admin\GradeController::class);
    Route::resource('students', \App\Http\Controllers\Admin\StudentController::class);
    Route::resource('questions', \App\Http\Controllers\Admin\QuestionController::class);
    Route::resource('tests', \App\Http\Controllers\Admin\TestController::class);
    Route::post('addQuestions/{id}', [\App\Http\Controllers\Admin\TestController::class, 'addQuestion'])->name('addQuestions');
    Route::resource('subjects', \App\Http\Controllers\Admin\SubjectController::class);
    Route::delete('questions/{question_id}/{test_id}', [\App\Http\Controllers\Admin\TestController::class, 'deleteQuestion'])->name('questionDelete');

});

Route::group(['prefix' => 'exam'], function () {
    Route::get('/online/test/{id}', [\App\Http\Controllers\Admin\ExamController::class, 'examTest'])->name('test-exam');
    Route::post('/results', [\App\Http\Controllers\Admin\ExamController::class, 'results'])->name('exam.results');


});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/login', [LoginController::class, 'showStudentLoginForm'])->name('student.login');
    Route::get('/home', [\App\Http\Controllers\Student\StudentController::class, 'index'])->name('student.home');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::resource('test', \App\Http\Controllers\Student\TestController::class);
});

Route::resource('uploader', \App\Http\Controllers\UploadController::class);

