@extends('main')

@section('title', '| Edit Comment')

@section('content')

    <div class="container">

        {{-- Check if current user is logged-in or a guest --}}
        @if (Auth::guest())

            <p class="mt-5">Cheatn?, please <a href="/login/">login</a> to continue.</p>

        @else
            <div class="blog-header">
                <h1 class="blog-title">Edit Comment</h1>
            </div>

            <div class="row">
                <div class="col-md-8">

                    {{--
                        Check route:list for `comments.update` for more info
                        URL is comments/{comment}, `{comment}` meaning that we have to supply ID
                    --}}
                    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                        {{ csrf_field() }}

                        {{--
                            HTML forms do not support PUT, PATCH or DELETE actions.
                            So, when defining PUT, PATCH or  DELETE routes that are called from an HTML form,
                            you will need to add a hidden _method field to the form.
                        --}}
                        {{ method_field('PUT') }}

                        <input type="hidden" name="post_id" value="{{ $comment->post_id }}" />

                        <div class="form-group{{ $errors->has('comment_author') ? ' has-error' : '' }}">
                            <label for="comment_author">Name *</label> <br/>
                            <input type="text" name="comment_author" value="{{ $comment->comment_author }}" />

                            @if ($errors->has('comment_author'))
                                <span class="help-block">
					                <strong>{{ $errors->first('comment_author') }}</strong>
					            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('comment_author_email') ? ' has-error' : '' }}">
                            <label for="comment_author_email">Email Address *</label> <br/>
                            <input type="text" name="comment_author_email" value="{{ $comment->comment_author_email }}" />

                            @if ($errors->has('comment_author_email'))
                                <span class="help-block">
					                <strong>{{ $errors->first('comment_author_email') }}</strong>
					            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="comment_author_url">Website</label> <br/>
                            <input type="text" name="comment_author_url" value="{{ $comment->comment_author_url }}" />
                        </div>

                        <div class="form-group">
                            <label for="comment_content">Message</label> <br/>
                            <textarea cols="60" rows="6" name="comment_content">{{ $comment->comment_content }}</textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update" />
                            <a class="btn btn-primary" href="{{ route('comments.index') }}">Cancel</a>
                        </div>
                    </form>

                </div>

                <div class="col-md-4">
                    <p>Submitted on: {{ date('F j, Y', strtotime( $comment->created_at )) }} @ {{ date('h:i', strtotime( $comment->created_at )) }}</p>
                    <p>In response to: <a target="_blank" href="{{ route('single', $comment->post->post_slug) }}"><strong>{{ $comment->post_title }}</strong></a></p>
                </div>
            </div>

        @endif

    </div>
@endsection
