<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameraGroup extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'
    ];
    public function cameras()
    {
        return $this->hasMany(Camera::class);
    }

    public function alarms()
    {
        return $this->belongsToMany(Alarm::class);
    }
}
