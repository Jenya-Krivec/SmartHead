@extends('app')

@section('title', 'Simple widget')

@section('description', 'This is a simple widget for your website')

@section('keywords', 'SmartHead, widget')

@section('content')
    <main class="font-serif">
        <img src="{{asset('img/banner.png').'?v='.filemtime('img/banner.png')}}" alt="banner" class="w-full">
    </main>
@endsection
