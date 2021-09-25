<?php

namespace Database\Factories;

use App\Models\Hymn;
use Illuminate\Database\Eloquent\Factories\Factory;

class HymnFactory extends Factory
{
    protected $model = Hymn::class;

    public function definition()
    {
        return [
            'number'         => $this->faker->unique()->randomNumber(610),
            'name'           => $this->faker->name(),
            'biblical_verse' => $this->faker->name(),
            'chorus'         => $this->faker->text(),
        ];
    }
}
