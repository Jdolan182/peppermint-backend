<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'show_footer' => $this->show_footer,
            'is_active' => $this->is_active,
            'sections' => PageSectionResource::collection($this->pageSections),        
        ];
    }
}
