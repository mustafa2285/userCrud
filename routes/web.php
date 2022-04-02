<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\User\UserController;
use App\Models\User;


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

Route::get('/', [Controller::class, 'index']);

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $users = User::withCount('articles')->paginate(5);
    $user_id = Auth::user()->id;
    $user = User::find($user_id);
    return view('dashboard', compact('users','user'));
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified'],'prefix' => 'user'], function () {
    Route::get('user/{user_id}/article/{id}', [UserController::class,'destroy'])->whereNumber('id')->name('article.destroy');
    Route::resource('user/{user_id}/article', UserController::class);
});


Route::group(['middleware' => ['auth','IsAdmin'],'prefix' => 'admin'],function(){
    Route::get('users/{id}', [AdminController::class,'destroy'])->whereNumber('id')->name('users.destroy');
    Route::get('users/{user_id}/articles/{id}', [AdminArticleController::class,'destroy'])->whereNumber('id')->name('articles.destroy');
    Route::resource('users', AdminController::class);
    Route::resource('users/{user_id}/articles', AdminArticleController::class);
});