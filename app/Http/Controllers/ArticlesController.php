<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ArticlesController extends Controller
{
    /**
     * Display articles
     */
    public function getIndex() {
        $posts = Post::where('post_type', 'post')
            ->orderBy('created_at', 'desc')
            ->paginate( 6 );

        return view('articles.index', ['posts' => $posts]);
    }

    /**
     * Display single article
     *
     * $post_slug STRING Article slug
     */
    public function getSingle( $post_slug ) {
        $post = Post::where('post_slug', '=', $post_slug)->first();
    if($post)
        return view('articles.single', ['post' => $post]);
    else
        return view('errors.404');
    }
}
