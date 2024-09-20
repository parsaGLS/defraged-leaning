<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'subject',
        'treshold'
    ];
    public function objectConfigs()
    {
        return $this->belongsToMany(ObjectConfig::class);
    }
    public function communications()
    {
        return $this->belongsToMany(Communication::class);
    }

    public function cameraGroups()
    {
        return $this->belongsToMany(CameraGroup::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
