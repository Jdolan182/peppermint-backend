<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Page\PageResource;
use App\Http\Requests\Search\IndexRequest;
use App\Http\Requests\Page\PageEditRequest;
use App\Http\Requests\Page\PageCreateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PageController extends Controller
{

    /**
     * List Pages
     *
     * @param  IndexRequest $IndexRequest
     * @return App\Http\Resources\Page\PageResource
     */
    public function index(IndexRequest $request) :AnonymousResourceCollection
    {
        $search = $request->safe()->keyword ?? false;
        $limit = $request->limit ?? 30;

        $query = Page::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        return PageResource::collection($query->paginate($limit)->withQueryString());
    }

    /**
     * Get the page data
     *
     * @param  Page $page
     * @return App\Http\Resources\Page\PageResource
     */
    public function getPageData(Page $page) :PageResource
    {
        return new PageResource($page);
    }

    
    /**
     * Create Page
     * 
     * @param PageCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(PageCreateRequest $request) :JsonResponse
    {

        try{
            $page = Page::create(
                $request->all()
            );

            return response()->json([
                'status' => true,
                'message' => 'Page Created',
                'page' => new PageResource($page)
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

     /**
     * Edit Page.
     *
     * @param PageEditRequest $request
     * @param Page $page
     * @return App\Http\Resources\Blog\BlogResource
     */
    public function edit(PageEditRequest $request, Page $page) 
    {
        DB::beginTransaction();

        try {

            $page->update(
                $request->all()
            );

            DB::commit();

            return new PageResource($page->refresh());
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }


    /**
     * Delete Page.
     * 
     * @param Consumer $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Page $page) :JsonResponse
    {
        DB::beginTransaction();

        try{
         
            $page->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Page Deleted'
            ], 200);
        }
        catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
}

