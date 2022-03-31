<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\tasksController;
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


Route::middleware(['checkUserLogin'])->group(function () {

    Route::resource('User', customerController::class);

    Route::resource('Task',tasksController::class);

    Route::get('Customer/logOut',[customerController::class,'logOut']);


});

Route::get('/Login',[customerController::class,'login'])->name('login');
Route::post('/DoLogin',[customerController::class,'doLogin']);




#############################################################################
Route::get('Admin/create',[adminController::class,'create']);
Route::post('Admin/store',[adminController::class,'store']);

Route::get('Admin/login',[adminController::class,'login']);
Route::post('Admin/DoLogin',[adminController::class,'doLogin']);
###############################################################################


