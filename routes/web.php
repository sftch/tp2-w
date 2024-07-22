<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//dashboard withnout auth
Route::get('/dashboard', function () {
    return view('/dashboard/index');
})->name('dashboard');

Route::get('/dashboard/status', [DashboardController::class, 'getStatus']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/todos', function () {
        return view('todos');
    })->name('todos');
});
