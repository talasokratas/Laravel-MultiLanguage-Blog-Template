<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Helpers\Helper;
use App\Comment;
use Session;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $comment_status = $request->query('comment_status');

        if( $comment_status )
            $comments = Comment::where('comment_approved', 1)->paginate( 10 );
        else
            $comments = Comment::paginate( 10 );

        return view('comments.index', ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {


        $comment = new Comment;

        $comment->comment_author_ip     = $request->ip();
        $comment->user_id               = Auth::id();
        $comment->post_id               = $request->post_id;
        $comment->comment_author        = $request->comment_author;
        $comment->comment_author_email  = $request->comment_author_email;
        $comment->comment_author_url    = $request->comment_author_url;
        $comment->comment_content       = $request->comment_content;

        $comment->comment_approved      = 0;

        $comment->save();

        Session::flash('success', 'Your comment is waiting approval.');

        return redirect()->route('single', Helper::get_post_slug( $request->post_id ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail( $id );

        return view('comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {

        $comment = Comment::findOrFail( $id );

        $comment->comment_author        = $request->input('comment_author');
        $comment->comment_author_email  = $request->input('comment_author_email');
        $comment->comment_author_url    = $request->input('comment_author_url');
        $comment->comment_content       = $request->input('comment_content');

        $comment->comment_approved      = 0;

        $comment->save();

        Session::flash('success', 'Comment updated.');

        return redirect()->route('comments.edit', $id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail( $id );

        $comment->delete();

        Session::flash('success', 'Comment deleted');

        return redirect()->route('comments.index');
    }

    /**
     * Approved comment
     */
    public function approveComment( $id ) {

        if( empty( $id ) )
            return;

        $comment = Comment::findOrFail( $id );

        $comment->comment_approved = 1;

        $comment->save();

        Session::flash('success', 'Comment approved.');

        return redirect()->route('comments.index' );
    }

    /**
     * Unapproved comment
     */
    public function unapproveComment( $id ) {


        if( empty( $id ) )
            return;

        $comment = Comment::findOrFail( $id );

        $comment->comment_approved = 0;

        $comment->save();

        Session::flash('success', 'Comment unapproved.');

        return redirect()->route('comments.index' );
    }
}
