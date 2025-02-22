<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Authenticatable
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'image_filename',
        'content',
        'description',
        'category_id',
        'is_active',
        'live_date',
        'author_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'live_date' => 'datetime',
    ];

     /**
      * 
     * Get the blog category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * 
     * Get the blog author.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
