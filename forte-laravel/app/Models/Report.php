<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'latitude',
        'longitude',
        'user_id',
        'status',
    ];

    public function classifications()
    {
        return $this->belongsToMany(Classification::class, 'classification_report');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validation()
    {
        return $this->hasOne(Validation::class);
    }
}
