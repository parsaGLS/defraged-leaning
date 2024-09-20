<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'path',
        'size',
        'type'

    ];

    public function owner()
    {
        return $this->morphTo('has_media');
    }

    public static function make(Model $related, $file,string $name,string $path, string $type)
    {
        Storage::put("{$path}/$name",$file);
        $media=$related->media()->create([
           'name' => $name,
            'path' => $path,
            'type' => $type,
            'size' => $file->getSize()
        ]);
        return $media;
    }
}
