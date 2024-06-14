<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::get("/", "PageController@login")->name('login');
    Route::post("/login", "AuthController@ceklogin");
});

Route::group(['middleware' => ['auth']], function () { // Auth
    Route::get("/pet", "PageController@movies");
    Route::get("/pet/form-add", "PageController@addmovies");
    Route::get("/home", "PageController@home");
    Route::post("/save", "PageController@savemovies");
    Route::get("/form-edit/{id}", "PageController@editmovies");
    Route::put("/update/{id}", "PageController@updatemovies");
    Route::get("/delete/{id}", "PageController@deletemovies");
    Route::get("/user", "PageController@edituser");

    Route::post("/updateuser", "AuthController@updateuser"); // Rute untuk pembaruan password
    Route::get("/logout", "AuthController@ceklogout");
});
