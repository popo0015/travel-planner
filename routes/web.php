<?php

use App\Http\Controllers\DestinationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('destinations', DestinationController::class);

Route::get('/cause-error', function () {
    report(new \Exception('This is a server error.'));
    return response()->view('errors.500', [], 500);
})->name('500.error');

