<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'devices';
    protected $fillable = [
        'brand_id', 'device_name'
    ];

    public function Brand(){
        return $this->belongsTo(Brand::class , 'brand_id');
    }

    public function Defect(){
        return $this->hasMany(Defect::class , 'device_id');
    }
}
