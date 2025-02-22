<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageSectionTemplate extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'template',
    ];
}
