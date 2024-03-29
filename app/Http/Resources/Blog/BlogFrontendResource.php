<?php

namespace App\Http\Resources\Blog;

use App\Http\Resources\Blog\BlogCategoryFrontendResource;
use App\Http\Resources\User\UserFrontendResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogFrontendResource extends JsonResource
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
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'content' => $this->content,
            'category' => new BlogCategoryFrontendResource($this->category),
            'author' =>  new UserFrontendResource($this->author),
            'live_date' => $this->live_date,
            'created_at' => $this->created_at,
        ];
    }
}
