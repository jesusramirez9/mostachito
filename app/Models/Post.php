<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'user_id'];

    const BORRADOR = 1;
    const PUBLICADO = 2;
    
    public function images(){
        return $this->hasMany(Image::class);
    }
    
}
