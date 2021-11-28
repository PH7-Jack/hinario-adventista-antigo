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
        'slug',
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

    public function resolveRouteBinding($value, $field = null)
    {
        if ($field === 'slug') {
            return $this
                ->where('slug', $value)
                ->orWhere('number', $value)
                ->firstOrFail();
        }

        return $this->where($field, $value)->firstOrFail();
    }

    public function previous(): self
    {
        return self::query()->where('number', $this->number - 1)->firstOrFail();
    }

    public function next(): self
    {
        return self::query()->where('number', $this->number + 1)->firstOrFail();
    }
}
