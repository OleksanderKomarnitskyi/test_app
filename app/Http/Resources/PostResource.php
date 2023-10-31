<?php

namespace App\Http\Resources;

use App\Enums\Statuses;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title ?? "",
            'status' => Statuses::fromValue($this->status),
            'description' => $this->description ?? "",
            'author' => $this->author ? $this->author->full_name : "",
        ];
    }
}
