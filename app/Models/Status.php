<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = "statuses";
    protected $fillable = [
        'name',
        'slug',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeDateformat($query){
        return $query->select('*',DB::raw("DATE_FORMAT(created_at,'%d %M %Y') as formatcreated"),DB::raw("DATE_FORMAT(updated_at,'%d %M %Y') as formatupdated"));
    }

}
