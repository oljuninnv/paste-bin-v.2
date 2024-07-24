@extends('layout')

@section('content')
<div>   
    <form action="{{ route('paste.update', $paste->id) }}" method="POST" class="flex flex-col mt-[40px] gap-[10px] w-[100%]">
        @csrf
        @method('PUT')

        <h2 class="text-[20px]">Редактирование пасты</h2>

        <div class="mb-3 flex flex-col">
            <label for="title" class="form-label">Название пасты</label>
            <input type="text" class="w-[1000px] border-solid border-2" id="title" name="title" value="{{ old('title', $paste->title) }}" required>
        </div>

        <div class="mb-3 flex flex-col">
            <label for="content" class="form-label">Содержимое пасты</label>
            <textarea class="w-[1000px] h-[300px] border-2" id="content" name="content" rows="10" required>{{ old('content', $paste->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</div>
@endsection