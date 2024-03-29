<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'consumer';

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
        'content',
        'description',
        'category_id',
        'author_id',
        'is_active = 0',
        'date_live'
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
