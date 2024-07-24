@extends('layout')

@section('content')
<h2 class="text-[30px]">Регистрация</h2>
<form action="{{ route('register') }}" method="POST" class="flex flex-col gap-[10px] w-[400px]">
    @csrf
    <label>Username: <input type="text" class="border-solid border-2 w-[300px]" name="name" required></label>
    @error('name')
        <div class="text-red-500 text-sm">{{ $message }}</div>
    @enderror

    <label>Email: <input type="email" class="border-solid border-2 w-[300px]" name="email" required></label>
    @error('email')
        <div class="text-red-500 text-sm">{{ $message }}</div>
    @enderror

    <label>Password: <input type="password" class="border-solid border-2 w-[300px]" name="password" required></label>
    @error('password')
        <div class="text-red-500 text-sm">{{ $message }}</div>
    @enderror

    <button type="submit">Зарегистрироваться</button>
</form>
@endsection