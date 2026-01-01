<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    // Relasi ke report (many-to-many)
    public function reports()
    {
        return $this->belongsToMany(Report::class, 'classification_report');
    }
}
