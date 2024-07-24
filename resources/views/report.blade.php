@extends('layout')

@section('content')
    <h2 class="text-[30px] ">Жалоба на пост: 'paste/{{$paste->short_url}}</h2>
    <form action="{{ route('send_report', ['short_url' => $paste->short_url]) }}" method="POST">
        @csrf
        <textarea name="text" id="text" class="w-[100%] border-solid border-2" required></textarea>
        <label>Ваше полное имя: <input type="text" name="name" class="w-[100%] border-solid border-2" required></label>
        <button type="submit">Отправить</button>
    </form>
@endsection