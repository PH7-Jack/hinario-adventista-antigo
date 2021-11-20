<?php

namespace App\Http\Livewire\Hymns;

use App\Models\Hymn;
use App\View\Components\GuestLayout;
use Livewire\Component;

class View extends Component
{
    public Hymn $hymn;

    public function previous(): void
    {
        $this->redirect(route('hymns.view', $this->hymn->number - 1));
    }

    public function next(): void
    {
        $this->redirect(route('hymns.view', $this->hymn->number + 1));
    }

    public function render()
    {
        return view('livewire.hymns.view')->layout(GuestLayout::class);
    }
}
