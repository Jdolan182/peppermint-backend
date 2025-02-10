<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Blog\BlogResource;
use App\Http\Requests\Search\IndexRequest;
use App\Http\Requests\Blog\BlogEditRequest;
use App\Http\Requests\Blog\BlogCreateRequest;
use App\Http\Resources\Blog\BlogCategoryResource;
use App\Http\Resources\Blog\BlogFrontendResource;
use App\Http\Requests\Search\IndexRequestFrontend;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BlogController extends Controller
{
    public function test()
    {
        return outputJson('test');
    }

    /**
     * List blogs
     *
     * @param  IndexRequest $IndexRequest
     * @return App\Http\Resources\Blog\BlogResource
     */
    public function index(IndexRequest $request) :AnonymousResourceCollection
    {
        $search = $request->safe()->keyword ?? false;
        $limit = $request->limit ?? 30;

        $query = Blog::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('slug', 'LIKE', "%{$search}%")
                    ->orWhere('subtitle', 'LIKE', "%{$search}%");
            });
        }

        return BlogResource::collection($query->paginate($limit)->withQueryString());
    }

     /**
     * List blogs for frontend
     *
     * @param  IndexRequestFrontend $IndexRequestFrontend
     * @return App\Http\Resources\Blog\BlogFrontendResource
     */
    public function blogList(IndexRequestFrontend $request) :AnonymousResourceCollection
    {
        $search = $request->safe()->keyword ?? false;
        $limit = $request->limit ?? 30;

        $query = Blog::query();

        $query->where('is_active', '=', 1);
        $query->where('live_date', '<', Carbon::now());

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('slug', 'LIKE', "%{$search}%")
                    ->orWhere('subtitle', 'LIKE', "%{$search}%");
            });
        }

        return BlogFrontendResource::collection($query->paginate($limit)->withQueryString());
    }

    /**
     * Display the Blog resource.
     *
     * @param  Blog $blog
     * @return App\Http\Resources\Blog\BlogResource
     */
    public function show(Blog $blog) :BlogResource
    {
        return new BlogResource($blog);
    }

    /**
     * Create Blog
     * 
     * @param BlogCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(BlogCreateRequest $request) :JsonResponse
    {

        try{
            $blog = Blog::create(
                $request->all()
            );

            return response()->json([
                'status' => true,
                'message' => 'Blog Created',
                'user' => new BlogResource($blog)
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
     * Edit Blog.
     *
     * @param BlogEditRequest $request
     * @param Blog $blog
     * @return App\Http\Resources\Blog\BlogResource
     */
    public function edit(BlogEditRequest $request, Blog $blog) 
    {
        DB::beginTransaction();

        try {

            $blog->update(
                $request->all()
            );

            DB::commit();

            return new BlogResource($blog->refresh());
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Delete Blog.
     * 
     * @param Blog $blog
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Blog $blog) :JsonResponse
    {
        DB::beginTransaction();

        try{
         
            $blog->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Blog Deleted'
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

    public function categories() :AnonymousResourceCollection
    {
        return BlogCategoryResource::collection(BlogCategory::all());
    }
}
