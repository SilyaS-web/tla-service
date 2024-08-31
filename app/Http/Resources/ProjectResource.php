<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'user_id' => $this->seller_id,
            'product_name' => $this->product_name,
            'product_nm' => $this->product_nm,
            'product_link' => $this->product_link,
            'product_price' => $this->product_price,
            'status' => $this->status,
            'status_name' => $this->getStatusName(),
            'project_works' => ProjectWorkResource::collection($this->projectWorks),
            'project_files' => ProjectFileResource::collection($this->projectFiles),
            'marketplace_brand' => $this->marketplace_brand,
            'marketplace_category' => $this->marketplace_category,
            'marketplace_product_name' => $this->marketplace_product_name,
            'marketplace_description' => $this->marketplace_description,
            'marketplace_options' => $this->marketplace_options,
            'marketplace_rate' => $this->marketplace_rate,
            'is_blogger_access' => (bool) $this->is_blogger_access,
            'created_at' => date_format($this->created_at, 'd.m.y'),
        ];
    }
}
