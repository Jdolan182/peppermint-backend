<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends Model
{
    //
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        //
        'bgColour',
        'bgTextColour',
        //
        'secondBgColour',
        'secondBgHoverColour',
        'secondColour',
        'secondBgTextColour',
        'secondFocusColour',
        'secondHoverColour',
        //
        'textColour',
        'textHoverColour',
        'textBgHoverColour',
        //
        'secondTextColour',
        'secondTextHoverColour',
        //
        'thirdTextColour',
        //
        'mainButtonColour',
        'mainButtonHoverColour',
        //
        'is_active',
    ];

}
