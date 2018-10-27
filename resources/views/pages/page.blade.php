@extends('main')

@section('title')
    | {{ $page->post_title }}
@endsection

@section('content')

    <div class="blog-header">
        <h1 class="blog-title">{{ $page->post_title }}</h1>
        <p>{{ date('M j, Y', strtotime( $page->created_at )) }} <a href="{{ route('posts.edit', $page->id) }}">{Edit}</a></p>
    </div>

    <div class="row">
        <div class="col-sm-8 blog-main">

            <div class="blog-content">
                {!! nl2br( $page->post_content ) !!}
            </div><!-- /.blog-post -->

        </div><!-- /.blog-main -->

        <!--Sidebar-->
        @include('partials._sidebar')
    </div><!-- /.row -->
@endsection
