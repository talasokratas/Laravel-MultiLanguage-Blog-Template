<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment_author',
        'comment_author_email',
        'comment_author_url',
        'comment_content',
    ];

    protected $hidden = [
        'comment_author_ip',
        'user_id',
        'post_id ',
        'comment_approved',
    ];

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_ID');
    }
}
