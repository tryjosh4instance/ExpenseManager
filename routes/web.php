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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/expense-update/{id}', [App\Http\Controllers\HomeController::class, 'expenseupdate']);
Route::put('/expense-save/{id}', [App\Http\Controllers\HomeController::class, 'expensesave']);
Route::post('/expense-add', [App\Http\Controllers\HomeController::class, 'expenseadd']);
Route::delete('/expense-delete/{id}', [App\Http\Controllers\HomeController::class, 'expensedelete']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','admin']], function()
{
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::post('/expense-add-admin', [App\Http\Controllers\Admin\DashboardController::class, 'expenseaddadmin']);
    Route::delete('/expense-delete-admin/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'expensdeleteadmin']);
    Route::put('/expense-update-admin/{id} ', [App\Http\Controllers\Admin\DashboardController::class, 'expenseupdateadmin']);
    Route::get('/role-register', [App\Http\Controllers\Admin\RegisteredController::class, 'registered']);
    Route::get('/role-edit/{id}', [App\Http\Controllers\Admin\RegisteredController::class, 'registeredit']);
    Route::put('/role-register-update/{id}',[App\Http\Controllers\Admin\RegisteredController::class, 'registerupdate']);
    Route::delete('/role-delete/{id}',[App\Http\Controllers\Admin\RegisteredController::class, 'registerdelete']);
    Route::get('/abouts', [App\Http\Controllers\Admin\AboutusController::class, 'index']);
    Route::post('/save-aboutus', [App\Http\Controllers\Admin\AboutusController::class, 'store']);
    Route::get('/about-us/{id}', [App\Http\Controllers\Admin\AboutusController::class, 'edit']);
    Route::put('/aboutus-update/{id}', [App\Http\Controllers\Admin\AboutusController::class, 'update']);
    Route::delete('about-us-delete/{id}', [App\Http\Controllers\Admin\AboutusController::class, 'delete']);
    Route::post('/save-category', [App\Http\Controllers\Admin\ExpenseCategoryController::class, 'categoryadd']);
    Route::get('/expense-categories', [App\Http\Controllers\Admin\ExpenseCategoryController::class, 'index']);
    Route::put('/expense-category-update/{id}', [App\Http\Controllers\Admin\ExpenseCategoryController::class, 'categoryupdate']);
    Route::delete('/category-delete/{id}', [App\Http\Controllers\Admin\ExpenseCategoryController::class, 'categorydelete']);
});

