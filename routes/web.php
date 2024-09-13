<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function(){
    Route::get('/login','login')->name('login');
    Route::post('/login','login_action')->name('login_action');
    Route::get('/register','register')->name('register');
    Route::post('/register','register_action')->name('register_action');
})->middleware('guest');

Route::controller(ReaderController::class)->group(function(){
    Route::get('/','index')->name('homepage');
    Route::get('/book_detail/{id}','book_detail')->name('book_detail');

    Route::middleware('auth')->group(function(){
        Route::post('/send_request/{id}','send_request')->name('send_request');
        Route::get('/read_book/{id}','read_book')->name('read_book');
    });
});

Route::middleware(['auth','role:admin,librarian'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/dashboard','index')->name('dashboard');
        Route::get('/permissions','permissions')->name('permissions');
        Route::get('/permissionsLastHandle','permissionLastHandle')->name('permissionsLastHandle');
        Route::patch('/handlePermissions/{id}/handle', 'handlePermissions')->name('handlePermissions');
    });
    Route::resource('/users',UserController::class);
    Route::resource('/categories',CategoryController::class);
    Route::resource('/books',BooksController::class);
});


Route::post('/logout',[AuthController::class,'logout'])->name('logout')->middleware('auth');
