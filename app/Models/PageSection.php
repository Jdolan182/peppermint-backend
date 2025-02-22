<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageSection extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'order',
        'data',
        'page_id',
        'page_section_template_id'
    ];

    /**
     * Get the page this belongs to.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Get the section template to build thi section.
     */
    public function pageSectionTemplate(): BelongsTo
    {
        return $this->belongsTo(PageSectionTemplate::class);
    }
}
