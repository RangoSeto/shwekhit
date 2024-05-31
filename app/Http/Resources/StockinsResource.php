<?php

namespace App\Http\Resources;

use App\Models\Item;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockinsResource extends JsonResource
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
            'item_id'=>$this->item_id,
            'pocount'=>$this->pocount,
            'pharcount'=>$this->pharcount,
            'countbyeach'=>$this->countbyeach,
            'price'=>number_format($this->price,2,'.',','),
            'status_id'=>$this->status_id,
            'user_id'=>$this->user_id,
            'created_at'=>$this->created_at->format('d M Y'),
            'updated_at'=>$this->updated_at->format('d M Y'),
            'user'=>User::where('id',$this->user_id)->select(['id','name'])->first(),
            'item'=>Item::where('id',$this->item_id)->select(['id','name'])->first()
        ];
    }
}
