<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content','image_url', 'image', 'user_id'];

    public function images(){
        return $this->hasMany(Image::class);
    }
}
