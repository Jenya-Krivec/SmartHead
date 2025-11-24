@extends('admin.app')

@section('title', Auth::user()->name.' '.Auth::user()->surname)

@section('content')
    <main class="pt-20 pb-16 rounded-md flex" style="height: 100vh;">
        <div class="mx-auto px-4 flex flex-col items-center bg-gray-100 w-150 border-blue-1 border-2 pb-2 h-full overflow-y-auto overflow-x-hidden">
            @foreach($customer['tickets'] as $ticket)
                <div class="{{$ticket['is_incoming'] ? 'rounded-l-lg rounded-tr-lg ml-auto' : 'rounded-r-lg rounded-tl-lg mr-auto'}} border-2 border-gray-200 px-2 pt-2 mt-2 bg-white">
                    <div class="border-b-2 border-gray-200">{{$ticket['subject']}}</div>
                    <div class="text-xs">{{$ticket['text']}}</div>
                    @if($ticket['file'])
                        <div class="text-blue-500 text-xs border-t-2 border-gray-200">
                            @if(in_array($ticket['media'][0]['mime_type'], ['image/jpg', 'image/png', 'image/jpeg']))
                                <img src="{{asset($ticket['media'][0]['original_url'])}}" class="h-18" alt="{{$ticket['file']}}">
                            @endif
                            <a target="_blank" href="{{$ticket['media'][0]['original_url']}}">{{$ticket['file']}}</a>
                        </div>
                    @endif
                    <div class="text-gray-500" style="font-size:10px;">{{Carbon\Carbon::parse($ticket['created_at'])->format('d.m.Y H:i:s')}}</div>
                </div>
            @endforeach
        </div>
        <div class="mx-auto px-4 flex flex-col items-center w-full">
            <div class="p-2">Имя: {{ $customer['name'] }}</div>
            <div class="p-2">Телефон: {{ $customer['phone'] }}</div>
            <div class="p-2">Email: {{ $customer['email'] }}</div>
            <div class="p-2">Статус: {{ $customer['status'] }}</div>
            <form action="{{route('admin.customer', ['id' => $customer['id']])}}" method="POST" class="p-2">
                @csrf
                <input type="hidden" name="id" value="{{$customer['id']}}">
                <select id="status" name="status" class="appearance-none border rounded p-1 text-gray-700 focus:outline-none">
                    <option value="">Выберите cтатус</option>
                    <option value="new" {{ request()->get('status') === 'new' ? 'selected' : '' }}>Новий</option>
                    <option value="in progress" {{ request()->get('status') === 'in progress' ? 'selected' : '' }}>В работе</option>
                    <option value="processed" {{ request()->get('status') === 'processed' ? 'selected' : '' }}>Обработан</option>
                </select>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold p-1 px-2 rounded">Изменить</button>
            </form>
        </div>
    </main>
@endsection
