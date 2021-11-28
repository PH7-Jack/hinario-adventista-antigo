<?php

namespace Tests\Feature\Livewire\Hymns;

use App\Http\Livewire\Hymns\Index;
use App\Models\{Author, Hymn, Strophe};
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use LazilyRefreshDatabase;

    /**
     * @test
     *
     * The search order is the number, title and if any strophe matches the search
     */
    public function it_should_search_hymns()
    {
        $hymns = Hymn::factory()
            ->forSection()
            ->count(20)
            ->create();

        $hymn  = $hymns->get(7);
        $hymn2 = $hymns->get(4);

        Strophe::factory()
            ->for($hymn)
            ->sequence(
                ['text' => 'Strophe 1'],
                ['text' => 'Strophe 2'],
                ['text' => '777'],
                ['text' => 'ABC'],
            )
            ->count(4)
            ->create();

        $hymn2->update(['title' => 'ABC', 'number' => '777']);

        Livewire::test(Index::class, ['keyboard' => false])
            ->set('search', $hymn->number)
            ->assertSet('hymns.0.number', $hymn->number)
            ->set('search', $hymn->title)
            ->assertSet('hymns.0.title', $hymn->title)
            ->set('search', 'ABC')
            ->assertSet('hymns.0.title', $hymn2->title)
            ->assertSet('hymns.1.title', $hymn->title)
            ->set('search', '777')
            ->assertSet('hymns.0.number', $hymn2->number)
            ->assertSet('hymns.1.number', $hymn->number);
    }

    /** @test */
    public function it_should_render_hymns_and_authors()
    {
        $hymns = Hymn::factory()
            ->forSection()
            ->count(3)
            ->sequence(
                ['number' => 1, 'title' => 'Hymn 1'],
                ['number' => 2, 'title' => 'Hymn 2'],
                ['number' => 3, 'title' => 'Hymn 3'],
            )->create();

        $hymn = $hymns->get(0);

        $authors1 = Author::factory()->count(2)->hasAttached($hymn)->create();
        $author2  = Author::factory()->hasAttached($hymn)->create();

        Livewire::test(Index::class)
            ->set('search', 'hymn')
            ->set('keyboard', false)
            ->assertSeeTextInOrder(['Hymn 1', 'Hymn 2', 'Hymn 3'])
            ->assertSeeTextInOrder(['1', '2', '3'])
            ->assertSeeTextInOrder([
                $authors1->implode(', '),
                $author2->name,
                'Autor Desconhecido',
            ]);
    }

    /** @test */
    public function it_should_save_in_session_the_current_keyboard_value()
    {
        Livewire::test(Index::class)->toggle('keyboard');

        Livewire::test(Index::class)->assertSet('keyboard', false);

        $this->assertEquals(false, session('hymns.keyboard'));
    }
}
