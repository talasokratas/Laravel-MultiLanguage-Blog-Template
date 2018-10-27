<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Post;
use Session;

class PagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Post::where('post_type', 'page')->paginate( 10 );

        return view('pages.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $page = new Post;

        $page->author_ID        = $request->author_ID;
        $page->post_type        = $request->post_type;
        $page->post_title       = $request->post_title;
        $page->post_slug        = $request->post_slug;
        $page->post_content     = $request->post_content;
        $page->post_locale      = $request->post_locale;

        $page->save();

        Session::flash( 'success', 'Page published.' );

        return redirect()->route('pages.show', $page->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Post::find( $id );

        return view('pages.show', [ 'page' => $page ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Post::find( $id );

        return view('pages.edit', [ 'page' => $page ]);
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

        $page = Post::find($id);

        $page->author_ID        = $request->author_ID;
        $page->post_type        = $request->post_type;
        $page->post_title       = $request->post_title;
        $page->post_slug        = $request->post_slug;
        $page->post_content     = $request->post_content;
        $page->post_locale      = $request->post_locale;

        $page->save();

        Session::flash('success', 'Page updated.');

        return redirect()->route('pages.edit', $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Post::find( $id );
        $page->delete();

        Session::flash('success', 'Page deleted.');

        return redirect()->route('pages.index');
    }


    /**
     * Front page
     */
    public function getIndex($slug) {

        if($slug) {

            $post = Post::where('post_slug', $slug)
                ->where('post_type', 'page')
                ->first();

            if ($post)
                return view('pages.page', ['page' => $post]);
            else
                return view('errors.404');

        } else {

            $posts = Post::where('post_type', 'post')
                ->paginate(6);

            return view('pages.frontpage', ['posts' => $posts]);
        }

    }



}
