<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'order_number'  => $this->order_number,
            'status'        => $this->status()->getLabel(),
            'pizzas'        => PizzaResource::collection($this->pizzas),
            'created_at'    => $this->created_at,
        ];
    }
}
