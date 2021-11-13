<?php

use App\Http\Livewire\Hymns;
use Illuminate\Support\Facades\Route;

Route::get('/', Hymns\Index::class)->name('hymn.index');
