<?php

use App\Http\Controllers\ImageController;
use App\Http\Livewire\Admin\ShowHome;
use App\Http\Livewire\Admin\ShowService;
use App\Http\Livewire\Admin\ShowSlide;
use App\Http\Livewire\ShowPosts;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', ShowPosts::class)->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/servicios', ShowService::class)->name('servicios');
Route::middleware(['auth:sanctum', 'verified'])->get('/home', ShowHome::class)->name('home');
Route::middleware(['auth:sanctum', 'verified'])->get('/slides', ShowSlide::class)->name('slides');
// Route::post('image/upload', [ImageController::class, 'upload'])->name('image.upload');