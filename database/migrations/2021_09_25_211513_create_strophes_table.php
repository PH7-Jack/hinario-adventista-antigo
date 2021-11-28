<?php

use App\Models\Hymn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrophesTable extends Migration
{
    public function up()
    {
        Schema::create('strophes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hymn::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('text', 500);
            $table->timestamps();

            $table->index(['text']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('strophes');
    }
}
