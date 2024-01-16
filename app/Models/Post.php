<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const TYPE_PRIVATE= 0;
    const TYPE_PUBLIC= 1;

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
