<?php

namespace App\Http\Livewire\Hymns;

use App\Models\Hymn;
use App\View\Components\GuestLayout;
use Illuminate\Support\Collection;
use Livewire\Component;
use WireUi\Traits\Actions;

/** @property-read Collection $hymns */
class Index extends Component
{
    use Actions;

    public bool $keyboard = true;

    public ?string $search = null;

    public function mount()
    {
        $this->ensureSessionTab();
    }

    public function updatedKeyboard(bool $keyboard): void
    {
        session()->put('hymns.keyboard', $keyboard);
    }

    public function getHymnsProperty(): Collection
    {
        return Hymn::query()
            ->selectRaw(<<<SQL
                hymns.number,
                hymns.slug,
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

    private function ensureSessionTab(): void
    {
        $this->keyboard = session('hymns.keyboard', true);
    }

    public function open()
    {
        if ($this->search < 1 || $this->search > 610) {
            return $this->notification()->notify([
                'title'   => 'Você só pode digitar números entre 1 e 610',
                'icon'    => 'info',
                'timeout' => 3000,
            ]);
        }

        return $this->redirect(route('hymns.view', $this->search));
    }

    public function render()
    {
        return view('livewire.hymns.index')->layout(GuestLayout::class);
    }
}
