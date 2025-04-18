<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Testing\Fluent\Concerns\Has;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'site_id',
    ];

    /**
     * Relationships
     */

    /**
     * @return Site|BelongsTo
     */
    public function site(): Site|BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
