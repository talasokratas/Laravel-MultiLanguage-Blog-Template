@extends('main')

@section('title', '| Posts')

@section('content')

    <div class="container">

        {{-- Check if current user is logged-in or a guest --}}
        @if (Auth::guest())

            <p class="mt-5">Cheatn?, please <a href="/login/">login</a> to continue.</p>

        @else

            <div class="blog-header">
                <h1 class="blog-title">Posts <a class="btn btn-sm btn-primary" href="{{ route('posts.create') }}">Add New</a></h1>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Content</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                        {{-- Blade if and else --}}
                        @if( $posts->count() )
                            {{-- Blade foreach --}}
                            @foreach( $posts as $post )
                                <tr>
                                    <td>
                                        <strong>
                                            <a href="{{ route('posts.edit', $post->id) }}">
                                                {{ $post->post_title }}
                                            </a>
                                        </strong>
                                    </td>
                                    <td>{{ $post->author_ID }}</td>
                                    <td>
                                        @if ( strlen( $post->post_content ) > 60 )
                                            {{ substr( $post->post_content, 0, 60 ) }} ...
                                        @else
                                            {{ $post->post_content }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#">
                                            {{ $post->category_ID }}
                                        </a>
                                    </td>
                                    <td>Published {{ date( 'j/m/Y', strtotime( $post->created_at ) ) }}</td>
                                    <td>
                                        <form class="d-inline" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger" />
                                        </form>

                                        <a class="btn btn-sm btn-info" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else

                            <tr>
                                <td colspan="5">No post has been added yet!</td>
                            </tr>

                            @endif
                            </tr>
                    </table>

                    {{ $posts->links() }}

                </div>
            </div>

        @endif

    </div>

@endsection
