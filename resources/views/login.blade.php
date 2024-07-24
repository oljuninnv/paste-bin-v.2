@extends('layout')

@section('content')
    <h2 class="text-[30px]">Авторизация</h2>
    <form action="{{ route('auth') }}" method="POST" class="flex flex-col gap-[10px] w-[400px]">
        @csrf
        <label>Email: <input type="text" class="border-solid border-2 w-[300px]" name="email" required></label>
        
        @error('email')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    
        <label>Password: <input type="password" class="border-solid border-2 w-[300px]" name="password" required></label>
        
        @error('password')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    
        <button type="submit">Войти</button>
    
        @if ($errors->has('credentials'))
            <div class="text-red-500 text-sm mt-2">{{ $errors->first('credentials') }}</div>
        @endif
    </form>
@endsection