<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany};
use Illuminate\Database\Eloquent\{Builder, Model};

class Hymn extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'number',
        'title',
        'versicle',
    ];

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $query->when($search, function (Builder $query, string $search) {
            $search = "%{$search}%";

            return $query
                ->where('title', 'like', $search)
                ->orWhere('number', 'like', $search)
                ->orWhereHas('strophes', function (Builder $query) use ($search) {
                    return $query->where('text', 'like', $search);
                });
        });
    }

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
