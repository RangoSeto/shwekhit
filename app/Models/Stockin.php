<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockin extends Model
{
    use HasFactory;

    protected $table = "stockins";
    protected $primaryKey = 'id';
    protected $fillable = [
        'item_id',
        'pocount',
        'pharcount',
        'countbyeach',
        'price',
        'status_id',
        'user_id'
    ];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
