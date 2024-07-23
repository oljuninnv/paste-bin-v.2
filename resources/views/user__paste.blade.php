@extends('layout')

@section('content')
    <div class="flex flex-col gap-[10px] mb-[10px]">
        <h2 class="text-[30px] ">Паста пользователя: username</h2>
        <p>Синтаксис: syntax</p>
        <p>Дата публикации: date</p>
        <a href="#">
            <span class="bg-red-500 text-white p-[3px] rounded-md">Оставить жалобу</span>
        </a>
    </div>    
    <div class="bg-gray-100 mb-[40px] mt-[10px]">
        <ol class="list-disc">
            <li>1: Строка 1</li>
            <li>2: xdfnxfg</li>
            <li>3: ветнчорвч</li>
        </ol>
    </div>
    
    <h2>RAW Paste Data</h2>
    <textarea name="" id="" cols="30" rows="10" class="mb-[40px] w-[100%] border"></textarea>
    <h2>Ваш комментарий:</h2>
    <form action="">
        <textarea name="" id="" cols="30" rows="10" class="mb-[40px] w-[100%] border"></textarea>
        <button type="submit" class="w-[30px]">Отправить</button>
    </form>

    
@endsection