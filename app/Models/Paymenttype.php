<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Paymenttype extends Model
{
    use HasFactory;

    protected $table = 'paymenttypes';
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'slug',
        'status_id',
        'user_id'
    ];


    public  function status(){
        return $this->belongsTo(Status::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeDateformat($query)
    {
        return $query->select('*',DB::raw("DATE_FORMAT(created_at,'%d %M %Y') as formatcreated"),DB::raw("DATE_FORMAT(updated_at,'%d %M %Y') as formatupdated"));
    }
};