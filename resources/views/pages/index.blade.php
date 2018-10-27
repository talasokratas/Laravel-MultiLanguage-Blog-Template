@extends('main')

@section('title', '| Pages')

@section('content')

    <div class="container">

        {{-- Check if current user is logged-in or a guest --}}
        @if (Auth::guest())

            <p class="mt-5">Cheatn?, please <a href="/login/">login</a> to continue.</p>

        @else

            <div class="blog-header">
                <h1 class="blog-title">Pages <a class="btn btn-sm btn-primary" href="{{ route('pages.create') }}">Add New</a></h1>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Content</th>
                            <th>Date</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                        {{-- Blade if and else --}}
                        @if( $pages->count() )
                            {{-- Blade foreach --}}
                            @foreach( $pages as $page )
                                <tr>
                                    <td>
                                        <strong>
                                            <a href="{{ route('pages.edit', $page->id) }}">
                                                {{ $page->post_title }}
                                            </a>
                                        </strong>
                                    </td>
                                    <td>{{ $page->author_ID }}</td>
                                    <td>
                                        @if ( strlen( $page->post_content ) > 60 )
                                            {{ substr( $page->post_content, 0, 60 ) }} ...
                                        @else
                                            {{ $page->post_content }}
                                        @endif
                                    </td>
                                    <td>Published {{ date( 'j/m/Y', strtotime( $page->created_at ) ) }}</td>
                                    <td>
                                        <form class="d-inline" action="{{ route('pages.destroy', $page->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger" />
                                        </form>

                                        <a class="btn btn-sm btn-info" href="{{ route('pages.edit', $page->id) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else

                            <tr>
                                <td colspan="5">No page has been added yet!</td>
                            </tr>

                            @endif
                            </tr>
                    </table>

                    {{ $pages->links() }}

                </div>
            </div>

        @endif

    </div>

@endsection
