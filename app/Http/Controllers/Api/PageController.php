<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Resources\Page\PageResource;

class PageController extends Controller
{
    /**
     * Get the page data from slug
     *
     * @param  Page $page
     * @return App\Http\Resources\Page\PageResource
     */
    public function getPageData(Page $page) :PageResource
    {
        return new PageResource($page);
    }
}

