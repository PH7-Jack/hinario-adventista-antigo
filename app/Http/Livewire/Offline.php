<?php

namespace App\Http\Livewire;

use App\View\Components\GuestLayout;
use Livewire\Component;

class Offline extends Component
{
    public function render()
    {
        return view('livewire.offline')->layout(GuestLayout::class);
    }
}
