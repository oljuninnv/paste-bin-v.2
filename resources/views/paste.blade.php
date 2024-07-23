@extends('layout')

@section('content')
    <div class="flex justify-around">
        <div>
            <form action="" method="POST" class="flex flex-col gap-[10px] w-[100%]">
                <h2 class="text-[20px]">New Paste</h2>
                <textarea id="paste" class="w-[1000px] h-[300px] border-2"></textarea>
                <h2 class="text-[20px]">Optional Paste Settings</h2>
                <hr class="border-black">
                <label >Категория<select name="" id="" class="w-[100%] border-solid border-2 ">
                    {{-- Код для вывода списка категорий     --}}
                </select></label>
                <label >Теги<input type="text" name="" class="w-[100%] border-solid border-2">
                </input></label>
                <label >Синтаксис<select name="" id="" class="w-[100%] border-solid border-2 ">
                    {{-- Код для вывода списка синтаксисов     --}}
                </select></label>
                <label >Права доступа<select name="" id="" class="w-[100%] border-solid border-2 ">
                    {{-- Код для вывода прав для доступа     --}}
                </select></label>
                <label >Название пасты<input type="text" name="" class="w-[100%] border-solid border-2">
                </input></label>
                <button type="submit bg-slate-300 p-[5px] rounded-md">Создать пасту</button>
            </form>
        </div>
        <div>
            <div>
                <a href="#"><h2 class="text-[20px]">My pastes</h2></a>
                <div>
                    {{-- Здесь будут пасты пользователя --}}
                </div>
            </div>
            <div>
                <a href="#"><h2 class="text-[20px]">Public pastes</h2></a>
                <div>
                    {{-- Здесь будут публичные пасты --}}
                </div>
            </div>
        </div>
    </div>
    
</main>

@endsection