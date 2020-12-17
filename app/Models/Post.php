<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'text',
        'image', 
        'video', 
    ];    

    protected $appends = [
        'photo_url', 
        'video_url', 
    ];

    public function getPhotoUrlAttribute()
    { 
        return asset($this->image
        ? Storage::disk('local')->url($this->image)
        : $this->defaultPhotoUrl());
    }    
    public function getVideoUrlAttribute()
    { 
        return $this->video?asset(Storage::disk('local')->url($this->video)):null;
    }    
    protected function defaultPhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($this->text).'&color=7F9CF5&background=EBF4FF';
    }        
}
