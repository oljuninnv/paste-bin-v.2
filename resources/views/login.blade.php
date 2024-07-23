@extends('layout')

@section('content')
    <h2 class="text-[30px]">Авторизация</h2>
    <form action="" method="POST" class="flex flex-col gap-[10px] w-[400px]">
        <label>Username: <input type="text" class="border-solid border-2 w-[300px]"></input></label>
        <label>Password: <input type="password" class="border-solid border-2 w-[300px]"></input></label>
        <button type="submit">Войти</button>
    </form>
@endsection