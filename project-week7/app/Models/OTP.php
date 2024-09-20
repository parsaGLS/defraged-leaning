<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;
    protected $fillable=[
        'code'
    ];
    protected $table='otps';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
