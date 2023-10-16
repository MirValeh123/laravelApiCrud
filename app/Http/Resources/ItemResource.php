<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 *     schema="ItemResource",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="quantity", type="integer"),
 *     @OA\Property(property="price", type="number"),
 *     @OA\Property(property="color", type="string"),
 *     @OA\Property(property="weight", type="number"),
 *     @OA\Property(property="created_at", type="string", format="date-time")
 * )
 */

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'quantity'=>$this->qty,
            'price'=>$this->price,
            'color'=>$this->color,
            'weight'=>$this->weight,
            'created_at'=>$this->created_at->format('d/m/Y H:i:s')
        ];
    }
}
