<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Widget</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/tailwind.css').'?v='.filemtime('css/tailwind.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        input{
            outline: none;
        }
        textarea{
            -ms-overflow-style: none;
            scrollbar-width: none;
            outline: none;
        }
        textarea::-webkit-scrollbar{
            width: 0;
            height: 0;
        }
        textarea::placeholder{
            color: #5d5959;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
        }
    </style>
</head>
<body class="bg-gray-100">
<div id="chat" class="h-92 m-auto flex flex-col overflow-hidden">
    <div class="flex fixed w-full top-0 left-0 justify-between border-b-2 p-2 pl-4 bg-gray-100 border-gray-300 z-10">
        <div>Добрий день!</div>
    </div>
    <input type="text" name="name" class="hidden bg-white border-2 border-gray-300 rounded-md px-2 py-2 mt-2" placeholder="Введите имя" minlength="2" maxlength="255">
    <input type="tel" name="phone" class="hidden bg-white border-2 border-gray-300 rounded-md px-2 py-2 mt-2" placeholder="Введите телефон: +14155552671" minlength="8" maxlength="15">
    <input type="email" name="email" class="hidden bg-white border-2 border-gray-300 rounded-md px-2 py-2 mt-2" placeholder="Введите email" minlength="2" maxlength="255">
    <div id="message-container" class="flex overflow-y-auto overflow-x-hidden flex-col mt-10 px-2 pb-2">

    </div>
    <div id="input-container" class="bg-white fixed bottom-0 left-0 right-0 h-12">
        <div id="file-container" class="bg-white absolute bottom-22 left-0 right-0 h-6 hidden px-2 text-blue-500">
            <div class="flex items-center"></div>
            <div class="absolute right-2 top-0 cursor-pointer z-10 text-white bg-blue-500 rounded-full w-6 h-6 flex items-center justify-center" title="Удалить файл">X</div>
        </div>
        <input type="text" name="subject" class="absolute bottom-12 bg-white border-t-2 border-gray-300 px-2 py-2 w-full" placeholder="Введите тему" minlength="2" maxlength="255">
        <button id="attach" class="left-0 w-6 h-6 absolute bottom-3 z-10 cursor-pointer" title="Прикрепить файл">
            <img src="{{asset('img/widget/attach.png').'?v='.filemtime('img/widget/attach.png')}}" alt="attach">
            <input type="file" hidden="hidden">
        </button>
        <textarea name="message" class="bg-white absolute bottom-0 right-0 h-12 border-t-2 border-gray-300 pl-6 pr-6 py-2 overflow-hidden max-h-44 w-full" placeholder="Введите сообщение"></textarea>
        <button id="send-btn" class="right-0 w-6 h-6 absolute bottom-3 z-10 cursor-pointer" title="Отправить сообщение">
            <img src="{{asset('img/widget/send.png').'?v='.filemtime('img/widget/send.png')}}" alt="send">
        </button>
    </div>
    <div id="error" class="hidden bg-white fixed left-0 w-full border-2 border-red-500 rounded-md" style="top:50%;transform:translate(0%, -50%);">
        <div class="w-full h-12 flex items-center justify-center border-b-2 border-gray-300">
            <div class="flex items-center justify-center text-red-500" title="Закрыть">Возникла ошибка</div>
            <div class="absolute top-3 right-3 cursor-pointer z-10 text-white bg-blue-500 rounded-full w-6 h-6 flex items-center justify-center" title="Закрыть">X</div>
        </div>
        <div class="p-2 text-red-500"></div>
    </div>
</div>
<script defer type="text/javascript" src="{{asset('js/widget/textarea.js').'?v='.filemtime('js/widget/textarea.js')}}"></script>
<script defer type="text/javascript" src="{{asset('js/widget/chat.js').'?v='.filemtime('js/widget/chat.js')}}"></script>
</body>
</html>
