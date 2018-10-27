<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Post;
use Image;
use Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('post_type', 'post')->paginate( 10 );

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $post = new Post;

        $post->author_ID        = $request->author_ID;
        $post->post_type        = $request->post_type;
        $post->post_title       = $request->post_title;
        $post->post_slug        = $request->post_slug;
        $post->post_content     = $request->post_content;
        $post->category_ID      = $request->category_ID;
        $post->post_locale      = $request->post_locale;

        if( $request->hasFile('post_thumbnail') ) {
            $post_thumbnail     = $request->file('post_thumbnail');
            $filename           = time() . '.' . $post_thumbnail->getClientOriginalExtension();

            Image::make($post_thumbnail)->resize(600, 600)->save( public_path('uploads/' . $filename ) );
            $post->post_thumbnail = $filename;
        }

        $post->save();

        Session::flash( 'success', 'Post published.' );

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find( $id );

        return view('posts.show', [ 'post' => $post ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find( $id );

        return view('posts.edit', [ 'post' => $post ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        $post->author_ID        = $request->input('author_ID');
        $post->post_type        = $request->input('post_type');
        $post->post_title       = $request->input('post_title');
        $post->post_slug        = $request->input('post_slug');
        $post->post_content     = $request->input('post_content');
        $post->category_ID      = $request->input('category_ID');
        $post->post_locale      = $request->post_locale;


        if( $request->hasFile('post_thumbnail') ) {
            $post_thumbnail     = $request->file('post_thumbnail');
            $filename           = time() . '.' . $post_thumbnail->getClientOriginalExtension();

            Image::make($post_thumbnail)->resize(600, 600)->save( public_path('/uploads/' . $filename ) );

            $post->post_thumbnail = $filename;
        }

        $post->save();

        Session::flash('success', 'Post updated.');

        return redirect()->route('posts.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find( $id );

        $post->delete();

        Session::flash('success', 'Post deleted.');

        return redirect()->route('posts.index');
    }
}

