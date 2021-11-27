<?php

use App\Models\{Category, Section};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHymnsTable extends Migration
{
    public function up()
    {
        Schema::create('hymns', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Section::class)->constrained()->cascadeOnDelete();
            $table->integer('number')->unique();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('versicle');
            $table->timestamps();

            $table->index(['number', 'slug', 'title']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('hymns');
    }
}
