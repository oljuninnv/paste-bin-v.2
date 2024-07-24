@extends('layout') 

@section('content')
    <form action="{{ route('search') }}" method="get" class="flex gap-[5px] mb-4">
        <input type="text" name="query" id="search" placeholder="Введите название..." class="border p-2 rounded-md">
        <button type="submit" class="bg-white p-[3px] rounded-md text-black">Поиск</button>
    </form>

    <table class="w-[1000px] align-middle text-center border">
        <thead class="border">
            <tr>
                <th class="border w-[500px]">Название</th>
                <th class="border">Дата публикации</th>
                <th class="border">Синтаксис</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pastes as $paste)
                @if($paste->short_url) <!-- Проверяем наличие short_url -->
                    <tr>
                        <td class="border">                
                            <a href="{{ route('user_paste', $paste->short_url) }}">{{ $paste->title }}</a>               
                        </td>
                        <td class="border">{{ $paste->created_at->format('d.m.Y H:i') }}</td>
                        <td class="border">
                            @foreach ($syntaxes as $syntax)
                                @if($syntax->id == $paste->syntax_id)
                                    {{$syntax->name}}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection