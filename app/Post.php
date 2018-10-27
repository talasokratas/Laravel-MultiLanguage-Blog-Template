<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'post_title',
        'post_slug',
        'post_content',
        'post_locale',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
