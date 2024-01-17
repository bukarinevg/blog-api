<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable= [
        'title',
        'content',
        'type',
    ];

    const TYPE_PRIVATE= 0;
    const TYPE_PUBLIC= 1;

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public static function types(){
        return [
            self::TYPE_PRIVATE => 'private',
            self::TYPE_PUBLIC => 'public',
        ];
    }


}
