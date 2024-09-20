<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'ip',
        'port',
        'description',
        'cameraGroup_id',
        'camera_code'
    ];

    public function cameraGroup()
    {
        return $this->belongsTo(CameraGroup::class);
    }
}
