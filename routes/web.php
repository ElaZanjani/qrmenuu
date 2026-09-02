<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/mikale-giris-x7k92', function () {
    return view('mikale');
});

Route::get('/mutfak', function () {
    return view('mutfak');
});