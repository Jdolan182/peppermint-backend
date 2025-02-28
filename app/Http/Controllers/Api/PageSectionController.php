<?php

namespace App\Http\Controllers\Api;

use App\Models\PageSection;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Page\PageSectionResource;
use App\Http\Requests\Page\PageSectionEditRequest;

class PageSectionController extends Controller
{
     /**
     * Edit Page section.
     *
     * @param PageSectrionEditRequest $request
     * @param PageSection $pageSection
     * @return App\Http\Resources\Blog\BlogResource
     */
    public function edit(PageSectionEditRequest $request, PageSection $pageSection) 
    {
        DB::beginTransaction();

        try {

            $pageSection->update(
                $request->all()
            );

            DB::commit();

            return new PageSectionResource($pageSection->refresh());
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
}
