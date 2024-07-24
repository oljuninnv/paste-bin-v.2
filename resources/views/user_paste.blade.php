@extends('layout')

@section('content')
    <div class="flex flex-col gap-[10px] mb-[10px]">
        <h2 class="text-[30px]">Паста пользователя: {{$username->name}}</h2>
        <h2>Название пасты: {{$paste->title}}</h2>
        <p>Синтаксис: {{$syntax->name}}</p>
        <p>Дата публикации: {{ $paste->created_at->format('d.m.Y H:i') }}</p>

        @if (Auth::check() && Auth::id() === $paste->user_id)
            <a href="{{ route('paste.edit', $paste->id) }}">
                <span class="bg-blue-500 text-white p-[3px] rounded-md">Редактировать</span>
            </a>
        @endif

        @if (Auth::check() && Auth::id() !== $paste->user_id)
            <a href="{{ route('report', $paste->short_url) }}">
                <span class="bg-red-500 text-white p-[3px] rounded-md">Оставить жалобу</span>
            </a>
        @endif
    </div>    
    <div class="bg-gray-100 mb-[40px] mt-[10px] pt-[20px] pb-[20px] pl-[10px]">
        {{ $paste->content }}
    </div>
    
@endsection