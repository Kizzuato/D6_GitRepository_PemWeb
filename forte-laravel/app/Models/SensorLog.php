<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorLog extends Model
{
    use HasFactory;

    protected $fillable = ['sensor_id', 'value', 'status', 'captured_at'];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
