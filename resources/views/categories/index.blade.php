@extends('main')

@section('title', '| Categories')

@section('content')

    <div class="container">

        {{-- Check if current user is logged-in or a guest --}}
        @if (Auth::guest())

            <p class="mt-5">Cheatn?, please <a href="/login/">login</a> to continue.</p>

        @else

            <div class="blog-header">
                <h1 class="blog-title">Categories <a class="btn btn-sm btn-primary" href="{{ route('categories.create') }}">Add New</a></h1>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                        {{-- Blade if and else --}}
                        @if( $categories )
                            {{-- Blade foreach --}}
                            @foreach( $categories as $category )
                                <tr>
                                    <td>
                                        <strong>
                                            <a href="{{ route('categories.edit', $category->id) }}">
                                                {{ $category->category_name }}
                                            </a>
                                        </strong>
                                    </td>
                                    <td>Published {{ date( 'j/m/Y', strtotime( $category->created_at ) ) }}</td>
                                    <td>
                                        <form class="d-inline" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger" />
                                        </form>

                                        <a class="btn btn-sm btn-info" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </tr>
                    </table>

                    {{ $categories->links() }}

                </div>
            </div>

        @endif

    </div>

@endsection
