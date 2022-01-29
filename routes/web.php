<?php

use App\Http\Livewire\{Hymns, Offline};
use Illuminate\Support\Facades\Route;

Route::get('/', Hymns\Index::class)->name('hymns.index');
Route::get('/hino/{hymn:slug}', Hymns\View::class)->name('hymns.view');
Route::get('/offline', Offline::class)->name('offline');
