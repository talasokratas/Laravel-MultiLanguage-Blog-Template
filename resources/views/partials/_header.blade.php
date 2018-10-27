
<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}" />
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">

    @yield('stylesheet')
</head>
<body>
<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <ul class="nav navbar-nav">
                <li><a class="blog-nav-item {{ Request::is('/') ? 'home' : '' }}" href="/">{{__('Home')}}</a></li>
                <li><a class="blog-nav-item {{ Request::is('blog') ? 'active' : '' }}" href="/blog">{{__('Blog')}}</a></li>
                <li><a class="blog-nav-item {{ Request::is('about') ? 'active' : '' }}" href="/about">{{__('About')}}</a></li>
                <li><a class="blog-nav-item {{ Request::is('contact') ? 'active' : '' }}" href="/contact">{{__('Contact')}}</a></li>
                @if( Helper::get_pages() )
                    @foreach( Helper::get_pages() as $page )
                        @if($page->post_locale == Config::get('app.locale'))
                            <li><a class="blog-nav-item {{ $page->post_slug == Request::is($page->post_slug) ? 'active' : '' }}" href="/{{ $page->post_slug }}">{{ $page->post_slug }}</a></li>
                        @endif
                    @endforeach
                @endif

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/setlocale/lt"><img src="//flagpedia.net/data/flags/mini/lt.png" width="40" height="20"></a></li>
                <li><a href="/setlocale/en"><img src="//flagpedia.net/data/flags/mini/gb.png" width="40" height="20"></a></li>
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a class="blog-nav-item {{ Request::is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a></li>
                    <li><a class="blog-nav-item {{ Request::is('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a></li>

                @else

                    <li class="dropdown">
                        <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('posts.index') }}">{{__('All posts')}}</a></li>
                            <li><a href="{{ route('posts.create') }}">{{__('Add new')}}</a></li>
                            <li><a href="{{ route('categories.index') }}">{{__('Categories')}}</a></li>

                            <li><hr/></li>

                            <li><a href="{{ route('pages.index') }}">{{__('All pages')}}</a></li>
                            <li><a href="{{ route('pages.create') }}">{{__('Add new')}}</a></li>

                            <li><hr/></li>

                            <!--we'll work on this later-->
                            <li><a href="{{ route('comments.index') }}">{{__('All comments')}}</a></li>
                            <li><hr/></li>
                            <li> <a id="lfm" data-input="thumbnail" data-preview="holder" >{{__('File Manager')}}</a></li>
                            <li><hr/></li>

                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('Logout')}}</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
