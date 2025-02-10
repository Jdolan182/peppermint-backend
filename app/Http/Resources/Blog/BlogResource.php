<?php

namespace App\Http\Resources\Blog;

use App\Http\Resources\Blog\BlogCategoryResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'image_filename' => $this->image_filename,
            'description' => $this->description,
            'content' =>  $this->content,
            'category' => new BlogCategoryResource($this->category),
            'category_id' => $this->category_id,
            'author' =>  new UserResource($this->author),
            'is_active' => $this->is_active,
            'live_date' => $this->live_date,
            'created_at' => $this->created_at,
        ];
    }
}
