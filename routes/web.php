<?php

use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/submit-to-calendar', 'CalendarController@submit')->name('submit')->middleware(ProtectAgainstSpam::class);
Route::get('/oauth', 'CalendarController@oauth');
