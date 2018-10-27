@extends('main')

@section('title')
    {{ $category->category_name }}
@endsection

@section('content')

    <div class="container">

        {{-- Check if current user is logged-in or a guest --}}
        @if (Auth::guest())

            <p class="mt-5">Cheatn?, please <a href="/login/">login</a> to continue.</p>

        @else

            <div class="blog-header">
                <h1 class="blog-title">{{ $category->category_name }}</h1>
                <p>{{ date('M j, Y', strtotime( $category->created_at )) }} <a href="{{ route('categories.edit', $category->id) }}">{Edit}</a></p>
            </div>

        @endif

    </div>

@endsection
