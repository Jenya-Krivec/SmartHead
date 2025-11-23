<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#" xml:lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" content="notranslate">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="title" content="@yield('title')">
    <meta name="robots" content="all, max-snippet:-1, max-video-preview:-1, max-image-preview:large">
    <meta name="google-site-verification" content="">
    <title>@yield('title')</title>
    <meta property="og:site_name" content="SmartHead"/>
    <meta property="og:type" content="website">
    <meta property="og:description" content="@yield('description')"/>
    <meta property="og:title" content="@yield('title')"/>
    <meta property="og:image" content="{{asset('img/logo.png').'?v='.filemtime('img/logo.png')}}">
    <meta property="og:image:secure_url" content="{{asset('img/logo.png').'?v='.filemtime('img/logo.png')}}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="260">
    <meta property="og:image:height" content="100">
    <meta name="theme-color" content="#164b82">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico').'?v='.filemtime('img/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/tailwind.css').'?v='.filemtime('css/tailwind.css')}}">
</head>
<body>
<div class="fixed top-0 left-0 w-full h-full bg-white z-30" id="preloader">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-1"></div>
    </div>
</div>
<header class="fixed w-full z-20">
    <nav class="flex items-center py-2">
        <div class="flex m-auto border-blue-1 border-2 py-2 rounded-full bg-white-1 border-box relative">
            <a href="{{route('index')}}" class="mx-4 sm:mx-10 flex justify-center items-center text-blue-1 font-bold">
                <div class="logo">
                    <img src="{{asset('img/logo.png').'?v='.filemtime('img/logo.png')}}" alt="SmartHead" class="w-6 mx-2 logo" width="150" height="150">
                </div>
                <p>SmartHead</p>
                <a href="" class="mr-4 sm:mr-10 flex justify-center items-center text-blue-1 font-bold">Login</a>
            </a>
        </div>
    </nav>
</header>
@yield('content')
<div class="fixed inset-0 bg-black opacity-50 z-20 hidden" id="overlay"></div>
<div class="fixed -bottom-40 left-0 right-0 bg-transparent z-20 transition-all duration-1000 hidden" id="cookie-message">
    <div class="bg-white w-full lg:w-1/3 mx-auto rounded-md p-6 shadow-lg border-2 border-blue-1">
        <h2 class="text-lg font-bold text-center">Cookies</h2>
        <p class="text-sm text-center">We use cookies to improve your experience on our site.</p>
        <div class="flex justify-center mt-4">
            <button class="bg-blue-1 text-white font-bold py-2 px-4 rounded-full transition-all duration-500" id="cookie-accept">Accept</button>
            <button class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-full ml-2 transition-all duration-500" id="cookie-decline">Decline</button>
        </div>
    </div>
</div>
<footer class="py-5 border-t-2 border-blue-1">
    <p class="text-sm text-blue-1 text-center font-bold">&copy; {{ date('Y') }} SmartHead</p>
</footer>
</body>
<script defer type="text/javascript" src="{{asset('js/preloader.js').'?v='.filemtime('js/preloader.js')}}"></script>
<script defer type="text/javascript" src="{{asset('js/cookie.js').'?v='.filemtime('js/cookie.js')}}"></script>
<script defer type="text/javascript" src="{{asset('js/widget/widget.js').'?v='.filemtime('js/widget/widget.js')}}"></script>
</html>

