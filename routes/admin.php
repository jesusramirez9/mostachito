<?php

use App\Http\Livewire\ShowPosts;
use Illuminate\Support\Facades\Route;

Route::get('/', ShowPosts::class)->name('admin.index');