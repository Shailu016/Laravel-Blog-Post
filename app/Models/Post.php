<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'excerpt',
        'body',
        'tag_id',
        'image_path',
    ];
      public function comments()
      {
          return $this->hasMany(Comment::class);
      }

      public function likes()
      {
          return $this->hasMany(Like::class);
      }

     
}
