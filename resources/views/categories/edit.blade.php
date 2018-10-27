@extends('main')

@section('title', '| Add New Category')

@section('content')

    <div class="container">

        {{-- Check if current user is logged-in or a guest --}}
        @if (Auth::guest())

            <p class="mt-5">Please <a href="/login/">login</a> to add a new post.</p>

        @else

            <div class="blog-header">
                <h1 class="blog-title">Add New Category</h1>
            </div>

            <div class="row">
                <div class="push-md-2 col-md-8">

                    {{--
                        Check route:list for `posts.update` for more info
                        URL is posts/{post}, `{post}` meaning that we have to supply ID
                    --}}
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        {{ csrf_field() }}

                        {{--
                            HTML forms do not support PUT, PATCH or DELETE actions.
                            So, when defining PUT, PATCH or  DELETE routes that are called from an HTML form,
                            you will need to add a hidden _method field to the form.
                        --}}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                            <label for="category_name">Title</label> <br/>
                            <input type="text" name="category_name" id="category_name" value="{{ $category->category_name }}" />

                            @if ($errors->has('category_name'))
                                <span class="help-block">
	                                <strong>{{ $errors->first('category_name') }}</strong>
	                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('category_slug') ? ' has-error' : '' }}">
                            <label for="category_slug">Slug</label> <br/>
                            <input type="text" name="category_slug" id="category_slug" value="{{ $category->category_slug }}" />

                            @if ($errors->has('category_slug'))
                                <span class="help-block">
	                                <strong>{{ $errors->first('category_slug') }}</strong>
	                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update" />
                            <a class="btn btn-primary" href="{{ route('categories.index') }}">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>

        @endif

    </div>

@endsection
