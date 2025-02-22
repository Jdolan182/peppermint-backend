<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Page\PageSectionTemplateResource;

class PageSectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'order' => $this->order,
            'data' => $this->data,
            'page_section_template' => new PageSectionTemplateResource($this->pageSectionTemplate)
        ];
    }
}
