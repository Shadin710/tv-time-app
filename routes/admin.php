<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AdminController::class)->group(function(){
    Route::get('/','index')->name('admin');

    //Category process
    Route::post('/categories','addCategory')->name('create-category');
    Route::get('/categories','getCategory')->name('categories');
    Route::put('/categories/{id}','updateCategory')->name('update-category');
    Route::delete('/categories/{id}','deleteCatgory')->name('delete-category');

    //Shows process
    Route::post('/shows','addShows')->name('show-create');
    Route::get('/shows','getShows')->name('shows');
    Route::put('/shows/{id}','updateShows')->name('update-shows');
    Route::delete('/shows/{id}','deleteShows')->name('delete-shows');

    //User Process
    Route::get('/users','getUsers')->name('users');


});
