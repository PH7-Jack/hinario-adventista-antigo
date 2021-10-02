<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany};

class Hymn extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'number',
        'title',
        'versicle',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function authores(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function strophes(): HasMany
    {
        return $this->hasMany(Strophe::class);
    }
}
