<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;
    protected $fillable = [
        'latitude',
        'longitude',
        'daya',
        'accelx',
        'accely',
        'accelz',
        'zone',
        'anomaly',
        'description',
        'user_id',
    ];
}
