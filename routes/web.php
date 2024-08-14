<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/contacts');
});

Route::resource('contacts', ContactController::class);
