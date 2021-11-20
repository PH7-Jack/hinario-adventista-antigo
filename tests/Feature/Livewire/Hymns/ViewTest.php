<?php

namespace Tests\Feature\Livewire\Hymns;

use App\Http\Livewire\Hymns\View;
use App\Models\Hymn;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ViewTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_should_render_all_hymn_strophes()
    {
        /** @var Hymn $hymn */
        $hymn = Hymn::factory()->forSection()->create([
            'number' => 1,
            'title'  => 'Hymn 1',
        ]);

        $hymn->strophes()->create([
            'title' => 'Parte 1',
            'text'  => 'La La La La',
        ]);

        $hymn->strophes()->create([
            'title' => 'Parte 2',
            'text'  => 'Le Le Le Le',
        ]);

        Livewire::test(View::class, ['hymn' => $hymn])->assertSeeTextInOrder([
            'Hymn 1',
            'Parte 1',
            'La La La La',
            'Parte 2',
            'Le Le Le Le',
        ]);
    }
}
