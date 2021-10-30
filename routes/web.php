<?php

use App\Http\Livewire\Hymn;
use Illuminate\Support\Facades\Route;

Route::get('/', Hymn\Index::class)->name('hymn.index');
