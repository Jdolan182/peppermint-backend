<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    //
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'title',
        'slug',
        'show_footer',
        'is_active'
    ];

    /**
     * Get the sections of this page.
     */
    public function pageSections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('order');
    }
}
