<?php

use App\Http\Controllers\userController;
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


// Route::get('x/{n}/{id?}',function($y,$x=""){
//     echo ' HI  '.$y.$x;
// })->where(['n'=>'[0-9]+','id'=>'[a-zA-Z]+']);

// Route :: get('User/create',function(){
//     return view('create');

// });

// Route:: view('User/create','create');

// Route:: post ('User/Store',function(){
//   echo 'Data Recived';
// });

Route::get('UserMessage',[userController::class,'Message']);
Route::get('User/create',[userController::class,'create']);
Route::post('User/Store',[userController::class,'store']);

Route::get('blog/create',[userController::class,'createBlog']);
Route::post('blog/Access',[userController::class,'Access']);
