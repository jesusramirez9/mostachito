<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
   
    use HasFactory;
    protected $fillable = ['image', 'image2','image3','image4','user_id'];

    
    const BORRADOR = 1;
    const PUBLICADO = 2;

    public function images(){
        return $this->hasMany(Image::class);
    }
}
