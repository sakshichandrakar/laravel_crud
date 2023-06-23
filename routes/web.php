<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;

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
Route::post('/login1', [EmployeeController::class, 'login']);
//Route::any('/managerlist', [EmployeeController::class, 'managerlist']);
Route::any('/logout1', [EmployeeController::class, 'logout1']);
//Route::any('/developerlist', [EmployeeController::class, 'developerlist']);

Auth::routes();
Route::middleware(['auth', 'user-access:1'])->group(function () {
  Route::get('/managerlist', [EmployeeController::class, 'managerlist'])->name('managerlist');
  Route::resource('employee', EmployeeController::class);

});
Route::middleware(['auth', 'user-access:0'])->group(function () {
  Route::get('/developerlist', [EmployeeController::class, 'developerlist'])->name('developerlist');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
