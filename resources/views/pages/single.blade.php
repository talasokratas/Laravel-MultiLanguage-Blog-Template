
@extends('main')

@section('title')
    | {{ $post->post_title }}
@endsection

@section('content')

    <div class="blog-header">
        <h1 class="blog-title">{{ $post->post_title }}</h1>
        <p>{{ $post->category_ID }} / {{ date('M j, Y', strtotime( $post->created_at )) }} <a href="{{ route('posts.edit', $post->id) }}">{Edit}</a></p>
    </div>

    <div class="row">
        <div class="col-sm-8 blog-main">

            <div class="blog-content">
                {!! nl2br( $post->post_content ) !!}
            </div><!-- /.blog-post -->

            <section class="mt-5" id="comment">
                <p>Comment goes here!</p>
            </section>

        </div><!-- /.blog-main -->

        <!--Sidebar-->
        @include('partials._sidebar')
    </div><!-- /.row -->

@endsection
