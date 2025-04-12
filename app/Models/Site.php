<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'domain',
    ];

    /**
     * Relationships
     */

    /**
     * @return Collection<v>|HasMany
     */
    public function categories(): Collection|HasMany
    {
        return $this->hasMany(Category::class);
    }

    /**
     * @return Collection<v>|HasMany
     */
    public function videos(): Collection|HasMany
    {
        return $this->hasMany(Video::class);
    }
}
