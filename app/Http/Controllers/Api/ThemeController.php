<?php

namespace App\Http\Controllers\Api;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Theme\ThemeResource;

class ThemeController extends Controller
{
    /**
     * Get active theme data
     */
    public function getActiveTheme()
    {
        //
        $theme = Theme::where('is_active', 1)->first();

        return new ThemeResource($theme);
    }

    /**
     * Set new active theme data
     */
    public function setActiveTheme(Request $request)
    {
        //
        DB::beginTransaction();

        try {

            $currentTheme = Theme::where('is_active', 1)->first();
            $newTheme = Theme::where('id', $request->theme)->first();
    
            $currentTheme->update([
                'is_active' => 0
            ]);

            $newTheme->update([
                'is_active' => 1
            ]);

            DB::commit();

            return new ThemeResource($newTheme->refresh());
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }

    }

    /**
     * Get all themese
     */
    public function getAllThemes()
    {
        //
        return ThemeResource::collection(Theme::all());
    }



}
