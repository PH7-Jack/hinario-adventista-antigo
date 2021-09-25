<?php

use App\Models\{Category, SubCategory};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHymnsTable extends Migration
{
    public function up()
    {
        Schema::create('hymns', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SubCategory::class)->constrained()->cascadeOnDelete();
            $table->integer('number')->unique();
            $table->string('name');
            $table->string('biblical_verse');
            $table->longText('chorus');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hymns');
    }
}
