<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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

     /**
     * Update Page section orders.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSectionOrder(Request $request) :JsonResponse
    {
        DB::beginTransaction();

        try {

            $pageSections = $request->get('sections');

            foreach($pageSections as $pageSection)
            {
                $section = PageSection::find($pageSection['id']);

                $section->order = $pageSection['order'];
                $section->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Order Updated'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
    
}

