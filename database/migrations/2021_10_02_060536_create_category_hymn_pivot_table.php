<?php

use App\Models\{Category, Hymn};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryHymnPivotTable extends Migration
{
    public function up()
    {
        Schema::create('category_hymn', function (Blueprint $table) {
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Hymn::class)->constrained()->cascadeOnDelete();

            $table->unique(['category_id', 'hymn_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_hymn');
    }
}
