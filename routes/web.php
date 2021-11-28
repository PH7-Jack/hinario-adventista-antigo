<?php

use App\Http\Livewire\Hymns;
use Illuminate\Support\Facades\Route;

Route::get('/', Hymns\Index::class)->name('hymns.index');
Route::get('/hino/{hymn:slug}', Hymns\View::class)->name('hymns.view');
