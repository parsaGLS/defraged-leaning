<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    use HasFactory;
    protected $fillable=[
        'type',
        'name',
        'token',
        'email',
        'host',
        'username',
        'password'
    ];

    public function alarms()
    {
        return $this->belongsToMany(Alarm::class);
    }
}
