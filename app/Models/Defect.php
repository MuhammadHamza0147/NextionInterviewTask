<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defect extends Model
{
    use HasFactory;
    protected $table = 'defects';

    protected $fillable = ['device_id' , 'defect_name' , 'original_price' , 'defect_precentage'];

    public function Device(){
        return $this->belongsTo(Device::class , 'device_id');
    }
}
