<?php

namespace App\Http\Livewire\Hymn;

use App\Models\Hymn;
use App\View\Components\GuestLayout;
use Illuminate\Support\Collection;
use Livewire\Component;

/** @property-read Collection $hymns */
class Index extends Component
{
    public bool $keyboard = true;

    public ?string $search = null;

    public function getHymnsProperty(): Collection
    {
        return Hymn::query()
            ->selectRaw(<<<SQL
                hymns.number,
                hymns.title,
                IFNULL(
                    GROUP_CONCAT(authors.name SEPARATOR ", "),
                    'Autor Desconhecido'
                ) as authors_names
            SQL)
            ->leftJoin('author_hymn', 'author_hymn.hymn_id', 'hymns.id')
            ->leftJoin('authors', 'author_hymn.author_id', 'authors.id')
            ->search($this->search)
            ->orderByRaw(<<<SQL
                case
                    when number like "%{$this->search}%" then 1
                    when title like "%{$this->search}%" then 2
                end DESC, number ASC, title ASC
            SQL)
            ->groupBy('hymns.id')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.hymn.index')->layout(GuestLayout::class);
    }
}
