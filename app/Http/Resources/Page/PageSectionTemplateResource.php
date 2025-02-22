<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Resources\Json\JsonResource;

class PageSectionTemplateResource extends JsonResource
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
            'template' => $this->template,
            'is_active' => $this->is_active,
        ];
    }
}
