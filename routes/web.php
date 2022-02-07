<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PasswordController;

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

   
//Private Group Routes
Route::group(['prefix'=>'admin', 'middleware' =>['isAdmin','auth']], function(){
        Route::get('dashboard', [AdminController::class,'index'])->name('admin.dashboard');
        Route::get('/admin/userdetails', [AdminController::class, 'getUser'])->name('get.user');

        Route::get('settings', [AdminController::class,'settings'])->name('admin.settings');
        Route::post('/admin/adduser', [AdminController::class,'store'])->name('add.user');
        Route::post('/admin/edituser', [AdminController::class,'EditUser'])->name('edit.user');
        Route::delete('/admin/delete', [AdminController::class,'destroy'])->name('delete.user');
        Route::get('/admin/adminlogs', [AdminController::class, 'getLogs'])->name('admin.logs');
        Route::post('/admin/resetpass', [AdminController::class,'resetpass'])->name('reset.pass');
        
        
    });

Route::group(['prefix'=>'user', 'middleware' =>['isUser','auth']], function(){
   
  
    Route::get('/search',[SearchController::class,'search'])->name('web.search');
    Route::get('/autocomplete', [SearchController::class,'autocomplete'])->name('autocomplete');
    
    
    Route::post('/changepass',[PasswordController::class,'changepassword'])->name('change.pass');

    Route::post('/guide/{slug}/comments',[CommentController::class, 'store'])->name('comment.store');
    Route::post('/guide/{slug}/like',[CommentController::class, 'savelike'])->name('like.store');
    Route::post('/guide/{slug}/unlike',[CommentController::class, 'saveUnlike'])->name('unlike.store');

    Route::post('/comments/{id}',[UserController::class, 'deletecomment'])->name('comments.delete');
    Route::get('user/dashboard', [UserController::class,'index'])->name('user.dashboard');   
    Route::get('user/guides', [UserController::class,'myGuides'])->name('user.guides');   
     
    Route::get('/guide/{slug}', [UserController::class,'show'])->name('manager.show');
    Route::get('/manager/GuideDetails',[ManagerController::class, 'getDetails'])->name('guides.details');
    
    Route::get('/allguides', [UserController::class,'AllGuides'])->name('all.guides');

   
    Route::get('guide', [UserController::class,'index'])->name('manager.guides');
    
    Route::get('settings', [ManagerController::class,'settings'])->name('manager.settings');
    Route::post('/manager/addGuide', [ManagerController::class,'SaveGuide'])->name('guides.add');
    Route::get('/manager/Guidelist', [ManagerController::class, 'getGuides'])->name('guides.list');
    Route::post('/manager/updateGuide',[ManagerController::class, 'GuideUpdate'])->name('guides.update');
    Route::delete('/manager/DeleteGuide',[ManagerController::class, 'deleteGuide'])->name('guides.delete');
    Route::get('/manager/dashboard', [ManagerController::class,'index'])->name('manager.dashboard');
    Route::get('/manager/historylogs', [ManagerController::class, 'getLogs'])->name('logs.list');
});

