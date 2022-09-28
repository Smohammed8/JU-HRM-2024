<?php

use App\Http\Controllers\Admin\EmployeeCrudController;
use App\Http\Controllers\Admin\EmployeeEvaluationCrudController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use App\Models\EmployeeEvaluation;

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

// Route::get('/', function () {
//     return redirect(route('backpack.dashboard'));
// });

Route::get('/dashboard', function () {
     return view('dashboard');
})->name('dashboard');

Route::get('/home',[EmployeeController::class,'home'])->name('home');

Route::get('/login',[AuthController::class,'userLoginView'])->name('login')->middleware('guest');
Route::post('/login_action',[AuthController::class,'login'])->name('login.auth')->middleware('guest');
//Route::post('insertbatch', [EmployeeCrudController::class, 'insertbatch'])->name('insertbatch');
Route::resource('employeeEvaluation', EmployeeEvaluationCrudController::class);
