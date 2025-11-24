@extends('admin.app')

@section('title', Auth::user()->name.' '.Auth::user()->surname)

@section('content')
    <main class="pt-20 pb-14">
        <form class="flex flex-col lg:flex-row justify-center w-full p-2 border-b-2 border-blue-1" action="{{route('admin.index')}}" method="GET">
            <div class="flex justify-center">
                <div class="flex">
                    <div class="flex mx-2">
                        <label for="date_from" class="block text-gray-700 text-sm mr-2 mt-2 font-bold">З</label>
                        <input id="date_from" type="date" name="date_from" value="{{ request()->get('date_from') }}" class="appearance-none border rounded p-1 text-gray-700 focus:outline-none">
                    </div>
                    <div class="flex mr-2">
                        <label for="date_from" class="block text-gray-700 text-sm mr-2 mt-2 font-bold">До</label>
                        <input id="date_to" type="date" name="date_to" value="{{ request()->get('date_to') }}" class="appearance-none border rounded p-1 text-gray-700 focus:outline-none">
                    </div>
                </div>
                <div class="lg:w-full mr-2">
                    <input id="email" type="email" name="email" value="{{ request()->get('email') }}" class="appearance-none border rounded p-1 text-gray-700 focus:outline-none" placeholder="Email">
                </div>
            </div>
            <div class="flex justify-center mt-2 lg:mt-0">
                <div class="lg:w-full mr-2">
                    <input id="phone" type="tel" name="phone" value="{{ request()->get('phone') }}" class="appearance-none border rounded p-1 text-gray-700 focus:outline-none" placeholder="Телефон: +14155552671">
                </div>
                <div class="lg:w-full mr-2">
                    <select id="status" name="status" class="appearance-none border rounded p-1 text-gray-700 focus:outline-none">
                        <option value="">Выберите cтатус</option>
                        <option value="new" {{ request()->get('status') === 'new' ? 'selected' : '' }}>Новий</option>
                        <option value="in progress" {{ request()->get('status') === 'in progress' ? 'selected' : '' }}>В работе</option>
                        <option value="processed" {{ request()->get('status') === 'processed' ? 'selected' : '' }}>Обработан</option>
                    </select>
                </div>
                <div class="mr-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold p-1 px-2 rounded">Поиск</button>
                </div>
            </div>
        </form>
        <div class="flex flex-col items-center">
            @foreach($customers as $customer)
                <form action="" method="GET" class="mt-2 w-full lg:w-280">
                    @csrf
                    <button type="submit" class="w-full grid grid-cols-4 p-2 border-2 border-blue-1 cursor-pointer">
                        <span class="p-2">Имя: {{ $customer['name'] }}</span>
                        <span class="p-2">Телефон: {{ $customer['phone'] }}</span>
                        <span class="p-2">Email: {{ $customer['email'] }}</span>
                        <span class="p-2">Статус: {{ $customer['status'] }}</span>
                    </button>
                </form>
            @endforeach
        </div>

    </main>
@endsection
