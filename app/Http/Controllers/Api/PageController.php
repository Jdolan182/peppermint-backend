<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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
        $is_active = $request->is_active ?? true;
        $exclude_id = $request->exclude_id ?? false;

        $query = Page::query();

        if ($is_active) {
            $query->where(function ($q) {
                $q->where('is_active', '=', "1");
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title','LIKE', "%{$search}%");
            });
        }

        if ($exclude_id) {
            $query->where(function ($q) use ($exclude_id) {
                $q->where('id','!=', $exclude_id);
            });
        }

        return PageResource::collection($query->paginate($limit)->withQueryString());
    }

     /**
     * List Pages for frontend
     *
     * @return App\Http\Resources\Page\PageResource
     */
    public function getPages() :AnonymousResourceCollection
    {
        $query = Page::query();
        $exclude_home = $request->exclude_home ?? true;


        if ($exclude_home) {
            $query->where(function ($q) {
                $q->where('id','!=', 1);
            });
        }

        $query->where(function ($q) {
            $q->where('is_active', '=', "1");
        });
        
        return PageResource::collection($query->paginate(30)->withQueryString());
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

    /**
     * Add new section to page Page.
     * 
     * @param Consumer $page
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addSection(Request $request, Page $page) :JsonResponse
    {
        DB::beginTransaction();

        try{

            $pageSection = [
                'order' => $page->pageSections->count() + 1,
                'data' => '{"params":{}}',
                'page_section_template_id' => $request->get('template_id')
            ];
         
            $page->pageSections()->create($pageSection);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Section Added'
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

