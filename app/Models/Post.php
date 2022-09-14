<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description',
        'published',
        'user_id',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'post_id', 'id');
    }

}
