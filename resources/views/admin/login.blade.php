@extends('admin.app')

@section('title', 'Login')

@section('content')
    <main class="flex justify-center items-center" style="height: calc(100vh - 85px)">
        <div class="w-80 border-2 border-blue-1 rounded-md container registerContainer mx-auto mainContainer my-2 flex flex-col justify-center p-5">
            <div>
                <div class="my-2 text-2xl">Login</div>
                <form method="POST" action="{{ route('admin.login') }}" autocomplete="off">
                    @csrf
                    <div class="form-group row relative my-6">
                        <div class="col-md-6">
                            <input id="email" type="email" class="w-full border-2 border-blue-1 outline-none px-1 rounded-lg h-8 bg-transparent form-control @error('name') border-red-600 @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="email">
                            <label for="email" class="absolute top-0 col-md-4 col-form-label text-md-right p-1 cursor-text left-0 transition-all duration-150 ease-in-out">Email</label>
                            @error('email')
                            <span class="text-red-600 text-sm">
                                <p>{{ $message }}</p>
                             </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row relative my-6">
                        <div class="col-md-6">
                            <input id="password" type="password" class="w-full border-2 border-blue-1 outline-none px-1 rounded-lg h-8 bg-transparent form-control @error('name') border-red-600 @enderror" name="password" required autocomplete="off" placeholder="password">
                            <label for="password" class="absolute top-0 col-md-4 col-form-label text-md-right p-1 cursor-text left-0 transition-all duration-150 ease-in-out">Password</label>
                            @error('password')
                            <span class="text-red-600 text-sm">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row relative my-6">
                        <div class="col-md-6">
                            <button type="submit" class="w-full bg-blue-1 text-white px-4 py-2 rounded-lg hover:bg-white hover:text-black border-2 border-blue-1 transition delay-150 duration-300 ease-in-out cursor-pointer">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
