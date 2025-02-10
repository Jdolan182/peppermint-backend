<?php

namespace App\Services\Images;

use Illuminate\Support\Facades\Storage;


/**
 * Stores and handles images
 */
class Images
{
   
     /**
     * Store image
     * 
     * @param Image $image
     * @param String $filename
     * @return Boolean
     */
    public static function StoreImage($image, $filename)
    {
        Storage::putFileAs('public/images/', $image, $filename);
    }
}