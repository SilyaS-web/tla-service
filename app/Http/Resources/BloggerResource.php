<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BloggerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'sex' => $this->sex,
            'is_achievement' => (bool) $this->is_achievement,
            'gender_ratio' => $this->gender_ratio,
            'status' => $this->status,
            'city' => $this->city,
            'country' => [
                'name' => $this->country->name,
                'id' => $this->country->id,
            ],
            'platforms' => BloggerPlatformResource::collection($this->platforms),
            'themes' => ThemeResource::collection($this->themes),
            'user' => new UserResource($this->user),
        ];
    }
}
