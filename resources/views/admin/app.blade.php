<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#" xml:lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" content="notranslate">
    <meta name="title" content="@yield('title')">
    <meta name="robots" content="all, max-snippet:-1, max-video-preview:-1, max-image-preview:large">
    <meta name="robots" content="noindex">
    <title>@yield('title')</title>
    <meta name="theme-color" content="#fbbf24">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico').'?v='.filemtime('img/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/tailwind.css').'?v='.filemtime('css/tailwind.css')}}">
</head>
<body>
<div class="fixed top-0 left-0 w-full h-full bg-white z-30" id="preloader">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-1"></div>
    </div>
</div>
<header class="fixed w-full z-30 border-b-2 border-blue-1 bg-white">
    <nav class="flex items-center py-5 w-full">
        <a href="{{route('admin.index')}}" class="mx-4 sm:mx-10 flex justify-center items-center text-blue-1 font-bold">
            <div class="logo">
                <img src="{{asset('img/logo.png').'?v='.filemtime('img/logo.png')}}" alt="SmartHead" class="w-6 mx-2 logo" width="150" height="150">
            </div>
            <p>SmartHead</p>
        </a>
        @if(Auth::check())
        <div class="relative align-self-center ml-auto">
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center text-blue-1 pl-2 pr-1 py-1 mr-4 cursor-pointer p-2" title="Logout">
                    <!-- SVG door -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12h5m-2-2l2 2-2 2" />
                    </svg>
                </button>
            </form>
        </div>
       @endif
    </nav>
</header>
@yield('content')
<div class="fixed inset-0 bg-black opacity-50 z-10 hidden" id="overlay"></div>
<footer class="py-5 fixed bottom-0 w-full border-t-2 border-blue-1 bg-white">
    <p class="text-sm text-blue-1 text-center font-bold">&copy; {{ date('Y') }} SmartHead</p>
</footer>
</body>
<script defer type="text/javascript" src="{{asset('js/preloader.js').'?v='.filemtime('js/preloader.js')}}"></script>
</html>

