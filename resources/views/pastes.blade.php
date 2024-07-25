{{-- Страница с выводом списка публичных паст --}}
@extends('layout')

@section('content')
    <h2 class="text-[30px] ">Публичные пасты</h2>
    <table class="w-[1300px] align-middle text-center border">
        <thead class="border">
            <tr>
                <th class="border w-[500px]">Название</th>
                <th class="border">Дата публикации</th>
                <th class="border">Синтаксис</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pastes as $paste)
    <tr>
        @if($paste->short_url) <!-- Проверяем наличие short_url -->
            <td class="border">                
                    <a href="{{ route('user_paste', $paste->short_url) }}">{{ $paste->title }}</a>               
            </td>
            <td class="border">{{ $paste->created_at->format('d.m.Y H:i') }}</td>
            <td class="border">
                @foreach ($syntaxes as $syntax)
                    @if($syntax->id == $paste->syntax_id)
                        {{$syntax->name}}
                    @endif
                @endforeach</td>
        @endif
    </tr>
@endforeach
        </tbody>
    </table>
@endsection