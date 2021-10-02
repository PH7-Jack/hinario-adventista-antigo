<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            $this->call(SectionSeeder::class);
            $this->call(HymnSeeder::class);
        });
    }
}
