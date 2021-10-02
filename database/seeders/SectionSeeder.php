<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class SectionSeeder extends Seeder
{
    public function run()
    {
        $categories = $this->getRawCategories();

        $categories->each(function (array $data) {
            /** @var Section $section */
            $section = Section::query()->create(['name' => data_get($data, 'name')]);

            $categories = collect(data_get($data, 'categories', []))->map(fn (array $category) => [
                'name' => data_get($category, 'name'),
            ]);

            $section->categories()->createMany($categories->toArray());
        });
    }

    private function getRawCategories(): Collection
    {
        $data = json_decode(file_get_contents(__DIR__ . '/hinario.json'), associative: true);

        $categories = Validator::make(data_get($data, 'sections'), [
            '*.name'               => 'required|string',
            '*.categories'         => 'required|array',
            '*.categories.*.name'  => 'required|string',
            '*.categories.*.range' => 'required',
        ])->validate();

        return collect($categories);
    }
}
