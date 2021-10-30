<?php

namespace App\Http\Livewire\Hymn;

use App\View\Components\GuestLayout;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.hymn.index')->layout(GuestLayout::class);
    }
}
