@extends('layout')

@section('content')
    @if(Auth::check())
    <h2>Мой токен:{{$user->remember_token}}</h2>
    @endif
    <h2 class="text-[30px] ">Мои пасты</h2>
    <table class="w-[1200px] align-middle text-center border">
        <thead class="border">
            <tr>
                <th class="border w-[400px]">Название</th>
                <th class="border">Дата публикации</th>
                <th class="border">Синтаксис</th>
                <th class="border">Категория</th>
                <th class="border">Право доступа</th>
                <th class="border">Доступен до</th>
                <th class="border">Ссылка</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pastes as $paste)
                <tr>
                    <td class="border">                
                        <a href="{{ route('user_paste', $paste->short_url) }}">{{ $paste->title }}</a>               
                    </td> <!-- Название пасты -->
                    <td class="border">
                        @if($paste->created_at instanceof \Carbon\Carbon)
                            {{ $paste->created_at->format('d.m.Y H:i') }}
                        @else
                            Не известно
                        @endif
                    </td> <!-- Дата публикации -->
                    <td class="border">
                        @foreach ($syntaxes as $syntax)
                            @if($syntax->id == $paste->syntax_id)
                                {{$syntax->name}}
                            @endif
                        @endforeach</td> <!-- Синтаксис -->
                        <td class="border">
                            @foreach ($categories as $category)
                                @if($category->id == $paste->category_id)
                                    {{$category->name}}
                                @endif
                            @endforeach</td> <!-- Категория -->
                            <td class="border">
                                @foreach ($rights as $right)
                                    @if($right->id == $paste->rights_id)
                                        {{$right->name}}
                                    @endif
                                @endforeach</td><!-- Право доступа -->
                    <td class="border">
                        @if($paste->access_time instanceof \Carbon\Carbon)
                            {{ $paste->access_time->format('d.m.Y H:i') }}
                        @else
                            Нет ограничения
                        @endif
                    </td> <!-- Доступен до -->
                    <td class="border">{{$paste->short_url}}</td> <!-- Ссылка -->
                </tr>
            @endforeach
        </tbody>
    </table>     
    
@endsection