<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function hymns(): HasMany
    {
        return $this->hasMany(Hymn::class);
    }
}
