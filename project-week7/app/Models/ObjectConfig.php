<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectConfig extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'object_code',
        'description'
    ];


    public function alarms()
    {
        return $this->belongsToMany(Alarm::class);
    }


}
