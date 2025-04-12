<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'category_id',
        'hls_path',
        'description',
        'thumbnail',
        'site_id',
        'views',
        'likes',
    ];

    /**
     * Relationships
     */

    /**
     * @return Category|BelongsTo
     */
    public function category(): Category|BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return Site|BelongsTo
     */
    public function site(): Site|BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
