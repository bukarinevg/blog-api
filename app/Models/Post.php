<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Post extends Model
{
    use HasFactory;

    //set model attributes expected from user
    protected $fillable= [
        'title',
        'content',
        'type',
        'user_id'
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

    //set model actions 

    protected static function boot()
    {
        parent::boot();
        

        static::saving(function ($post) {
            if (empty($post->slug)) {
                $slug = Str::slug($post->title);
                $count = Post::where('slug', 'like', "$slug%")->count();
    
                if ($count > 0) {
                    $slug .= '-' . ($count + 1);
                }
    
                $post->slug = $slug;
            }
           

            if($post->type == Post::TYPE_PUBLIC){
                $post->published_at = now();
            }


        });

        self::creating(function($model){
            // ... code here
        });

        self::created(function($model){
            // ... code here
        });

        self::updating(function($model){
            // ... code here
        });

        self::updated(function($model){
            // ... code here
        });

        self::deleting(function($model){
            // ... code here
        });

        self::deleted(function($model){
            // ... code here
        });
    }
    

}
