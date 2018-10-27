@extends('main')

@section('title', 'Comments')

@section('content')

    <div class="container">

        {{-- Check if current user is logged-in or a guest --}}
        @if (Auth::guest())

            <p class="mt-5">Cheatn?, please <a href="/login/">login</a> to continue.</p>

        @else

            <div class="blog-header">
                <h1 class="blog-title">Comments</h1>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <a href="{{ route('comments.index') }}">All</a> | <a href="{{ route('comments.index') }}/?comment_status=1">Approved</a>

                    <table class="table">
                        <tr>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>In Response To</th>
                            <th>Submitted On</th>
                            <th width="24%">&nbsp;</th>
                        </tr>
                        <tr>
                        {{-- Blade if and else --}}
                        @if( $comments->count() )
                            {{-- Blade foreach --}}
                            @foreach( $comments as $comment )
                                <tr>
                                    <td>
                                        <strong>
                                            <a href="{{ route('comments.edit', $comment->id) }}">
                                                {{ $comment->comment_author }}
                                            </a> <br/>

                                            <a href="mailto:{{ $comment->comment_author_email }}">
                                                {{ $comment->comment_author_email }}
                                            </a> <br/>

                                            {{ $comment->comment_author_ip }}
                                        </strong>
                                    </td>
                                    <td>
                                        {{ $comment->comment_content }}
                                    </td>
                                    <td>


                                        {{ $comment->post->title}} <br/>
                                        <a target="_blank" href="{{ route('single', $comment->post->post_slug ) }}">View Post</a>
                                    </td>
                                    <td>
                                        {{ date('F j, Y', strtotime( $comment->created_at )) }} @ {{ date('h:i', strtotime( $comment->created_at )) }}
                                    </td>
                                    <td>
                                        <?php if( $comment->comment_approved ) : ?>
                                        <form class="d-inline" action="{{ route('comment.unapprove', $comment->id) }}" method="POST">
                                            {{ csrf_field() }}

                                            <input type="submit" value="Unapprove" class="btn btn-sm btn-success" />
                                        </form>
                                        <?php else : ?>
                                        <form class="d-inline" action="{{ route('comment.approve', $comment->id) }}" method="POST">
                                            {{ csrf_field() }}

                                            <input type="submit" value="Approve" class="btn btn-sm btn-success" />
                                        </form>
                                        <?php endif; ?>
                                        |
                                        <form class="d-inline" action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger" />
                                        </form>

                                        <a class="btn btn-sm btn-info" href="{{ route('comments.edit', $comment->id) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else

                            <tr>
                                <td colspan="5">No comment has been added yet!</td>
                            </tr>

                            @endif
                            </tr>
                    </table>

                    {{ $comments->links() }}

                </div>
            </div>

        @endif

    </div>

@endsection
