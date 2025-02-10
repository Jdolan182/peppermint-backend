<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Services\Images\Images;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Upload image.
     */
    public function upload(Request $request)
    {

        try{
            if($request->hasFile('image')){
                
                $filename = $request->imageName;
                $image = $request->file('image');

                Images::storeImage($image, $filename);

                if (Storage::disk('images')->exists($filename)) {
    
                    Image::updateOrCreate([
                        'filename' => $filename
                    ]);

                    $url = Storage::url('public/images/' . $filename);

                    return response()->json([
                        'status' => true,
                        'message' => 'Image Uploaded',
                        'filename' => $filename
                    ], 200);
                }
                else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Image failed to upload'
                    ], 400);
                }
            }
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

}
