<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
    protected $fillable=[
        'cameraCode',
        'conf',
        'object',
        'description',
        'orginalImagepath',
        'imagePath'
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'has_media');
    }
}
