<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PageSectionTemplate;
use App\Http\Resources\Page\PageSectionTemplateResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PageSectionTemplateController extends Controller
{
    /**
     * Get All Page templates.
     *
     * @return App\Http\Resources\Page\PageSectionTemplateResource
     */
    public function getTemplates()  :AnonymousResourceCollection
    {
     
        return PageSectionTemplateResource::collection(PageSectionTemplate::where('is_active', 1)->get());    
    }
}
