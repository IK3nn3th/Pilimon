<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;

use Illuminate\Support\Facades\Auth; 
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
    return view('auth.login');
});


Auth::routes();
Route::post('/admin/adduser', [AdminController::class,'store']);
Route::post('/admin/edituser', [AdminController::class,'EditUser']);
Route::delete('/admin/delete', [AdminController::class,'destroy']);

Route::post('/manager/addGuide', [ManagerController::class,'SaveGuide']);
Route::get('/manager/Guidelist', [ManagerController::class, 'getGuides'])->name('guides.list');


Route::get('/manager/historylogs', [ManagerController::class, 'getLogs'])->name('logs.list');
Route::get('/admin/adminlogs', [AdminController::class, 'getLogs'])->name('admin.logs');


Route::post('/manager/updateGuide',[ManagerController::class, 'GuideUpdate'])->name('guides.update');
Route::delete('/manager/DeleteGuide',[ManagerController::class, 'deleteGuide'])->name('guides.delete');
Route::post('/guide/{slug}/comments',[CommentController::class, 'store'])->name('comment.store');
Route::post('/guide/{slug}/like',[CommentController::class, 'savelike'])->name('like.store');
Route::post('/comments/{id}',[UserController::class, 'deletecomment'])->name('comments.delete');
Route::get('/search',[SearchController::class,'search'])->name('web.search');
    

Route::group(['prefix'=>'admin', 'middleware' =>['isAdmin','auth']], function(){
        Route::get('dashboard', [AdminController::class,'index'])->name('admin.dashboard');
        Route::get('guide', [AdminController::class,'profile'])->name('admin.profile');
        Route::get('settings', [AdminController::class,'settings'])->name('admin.settings');
      
    });

Route::group(['prefix'=>'user', 'middleware' =>['isUser','auth']], function(){
   
    Route::get('/guide/{slug}', [UserController::class, 'show'])->name('guides.show');
    Route::get('settings', [UserController::class,'settings'])->name('user.settings');
    Route::get('dashboard', [UserController::class,'index'])->name('user.dashboard');
});

Route::group(['prefix'=>'manager', 'middleware' =>['isManager','auth']], function(){
    Route::get('dashboard', [ManagerController::class,'index'])->name('manager.dashboard');
    Route::get('guide', [UserController::class,'index'])->name('manager.guides');
    Route::get('settings', [ManagerController::class,'settings'])->name('manager.settings');
    Route::get('/manager/GuideDetails',[ManagerController::class, 'getDetails'])->name('guides.details');
    Route::get('/guide/{slug}', [UserController::class,'show'])->name('manager.show');
});

