<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function video_conversions(){
        return $this->hasMany(VideoConversion::class);
    }

    public function video_downloads(){
        return $this->hasMany(VideoDownload::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
