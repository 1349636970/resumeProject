<?php

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

Route::get("resume","resumeController@index");
Route::get("article","resumeController@article");

Route::middleware(['web','admin'])->group(function () {
    Route::any('admin','resumeController@admin');
    Route::any('admin/editor','resumeController@edtior');
    Route::any('admin/editor/workspace','resumeController@workspace');
    Route::any('admin/delete','resumeController@delete');
    Route::any('admin/delete/confirm','resumeController@confirm');
    Route::any('admin/check','resumeController@check');

});

Route::middleware(['web'])->group(function () {
    Route::any("login","resumeController@login");
    Route::any("register", "resumeController@Register");
});
