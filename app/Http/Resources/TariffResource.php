<?php

namespace App\Http\Resources;

use App\Enums\Statuses;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TariffResource extends JsonResource
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
            'title' => $this->title,
            'status' => Statuses::fromValue($this->status),
            'posts_count' => $this->posts_count,
            'price' => $this->price,
        ];
    }
}
