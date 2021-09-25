<?php

namespace Database\Factories;

use App\Models\Strophe;
use Illuminate\Database\Eloquent\Factories\Factory;

class StropheFactory extends Factory
{
    protected $model = Strophe::class;

    public function definition()
    {
        return [
            'text' => $this->faker->text(),
        ];
    }
}
