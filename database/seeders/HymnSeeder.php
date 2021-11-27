<?php

namespace Database\Seeders;

use App\Models\{Author, Category, Hymn, Section};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\{Collection, Str};

class HymnSeeder extends Seeder
{
    public function run()
    {
        $hymns = $this->getRawHymns();

        $hymns->each(function (array $data) {
            /** @var Section $section */
            $section = Section::query()->firstOrCreate(['name' => data_get($data, 'section')]);

            /** @var Category $category*/
            $category = $section->categories()->firstOrCreate(['name' => data_get($data, 'category')]);

            /** @var Hymn $hymn */
            $hymn = Hymn::query()->create([
                'section_id' => $section->id,
                'title'      => data_get($data, 'title'),
                'slug'       => Str::of(data_get($data, 'title')),
                'number'     => data_get($data, 'number'),
                'versicle'   => data_get($data, 'versicle'),
            ]);

            $hymn->categories()->attach($category);

            foreach (data_get($data, 'authors') as $author) {
                $author = Author::query()->firstOrCreate(['name' => $author]);

                $hymn->authores()->attach($author);
            }

            $hymn->strophes()->createMany(data_get($data, 'strophes', []));
        });
    }

    private function getRawHymns(): Collection
    {
        $data = json_decode(file_get_contents(__DIR__ . '/hinario.json'), associative: true);

        $hymns = Validator::make(data_get($data, 'hymns'), [
            '*.title'            => 'required|string',
            '*.number'           => 'required|numeric',
            '*.section'          => 'required|string',
            '*.category'         => 'required|string',
            '*.authors'          => 'sometimes|array',
            '*.authors.*'        => 'sometimes|nullable|string',
            '*.versicle'         => 'required|string',
            '*.strophes'         => 'required|array',
            '*.strophes.*.title' => 'required|string',
            '*.strophes.*.text'  => 'required|string',
        ])->validate();

        return collect($hymns);
    }
}
