<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"></link>        
    </head>
    <body>
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 border-bottom">
            <div href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            </div>

            <ul class="nav nav-pills">
                @auth
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Logout</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                @endauth
            </ul>
            </header>
        </div>

        @php
            $categories = Helper::getCategories();
        @endphp
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Simple header</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                @foreach($categories as $category)
                    <!--li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li-->
                    <li class="nav-item"><a href="#" class="nav-link">{{ $category->name }}</a></li>
                @endforeach
            </ul>
            </header>
        </div>

        <div class="container">
            @yield('site_content')
        </div>

        <style src="{{ asset('bootstrap/js/bootstrapp.js') }}"></style>
    </body>
</html>
