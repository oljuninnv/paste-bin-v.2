{{-- Страница с информацией по поводу api --}}
@extends('layout')

@section('content')
    <ul>
        <li>
            Получить всех пользователей: http://localhost:8001/api/user
        </li>
        <li>
            Получить пользователя по его id: http://localhost:8001/api/user/user/{id}
        </li>
        <li>
            Получить все пасты: http://localhost:8001/api/pastes
        </li>
        <li>
            Получить пасту по её ссылке: http://localhost:8001/api/paste/{short_url}
        </li>
        <li>
            Получить список жалоб: http://localhost:8001/api/complaints
        </li>
    </ul>
@endsection