{{-- Главная страница с формой добавления пасты --}}
@extends('layout')

@section('content')
    <div class="flex justify-around">
        <div>
            <form action="{{ route('store') }}" method="POST" class="flex flex-col gap-[10px] w-[100%]">
                @csrf
                <h2 class="text-[20px]">New Paste</h2>
                <textarea id="paste" name="content" class="w-[1000px] h-[300px] border-2" required></textarea>
                
                <h2 class="text-[20px]">Optional Paste Settings</h2>
                <hr class="border-black">
            
                <label>Категория
                    <select name="category_id" id="category_id" class="w-[100%] border-solid border-2" required>
                        {{-- Здесь должен быть код для вывода списка категорий --}}
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </label>
            
                <label>Время существования пасты
                    <select name="access_time" id="access_time" class="w-[100%] border-solid border-2">
                        
                        @foreach($access_times as $access_time)
                            <option value="{{ $access_time->id }}">{{ $access_time->name }}</option>
                        @endforeach
                    </select>
                </label>
            
                <label>Теги
                    <input type="text" name="tags" class="w-[100%] border-solid border-2" placeholder="Введите теги через запятую">
                </label>
            
                <label>Синтаксис
                    <select name="syntax_id" id="syntax_id" class="w-[100%] border-solid border-2" required>
                        {{-- Здесь должен быть код для вывода списка синтаксисов --}}
                        @foreach($syntaxes as $syntax)
                            <option value="{{ $syntax->id }}">{{ $syntax->name }}</option>
                        @endforeach
                    </select>
                </label>
            
                <label>Права доступа
                    <select name="rights_id" id="rights_id" class="w-[100%] border-solid border-2" required>
                        {{-- Здесь должен быть код для вывода прав доступа --}}
                        @foreach($rights as $right)
                            <option value="{{ $right->id }}">{{ $right->name }}</option>
                        @endforeach
                    </select>
                </label>
            
                <label>Название пасты
                    <input type="text" name="title" class="w-[100%] border-solid border-2" required>
                </label>
            
                <button type="submit" class="bg-slate-300 p-[5px] rounded-md">Создать пасту</button>
            </form>
        </div>
        <div>
            <div>
                <a href="{{ route("personal_pastes") }}"><h2 class="text-[20px]">My pastes</h2></a>
                <div>
                    {{-- Здесь будут пасты пользователя --}}
                    @if(empty($user_pastes) || !Auth::check())
                        <p>У вас пока нет паст.</p>
                    @else
                        <ul>
                            @foreach($user_pastes as $user_paste)
                                <li>
                                    <strong>{{ $user_paste->title }}</strong> - 
                                    <small>{{ $user_paste->created_at->format('d.m.Y H:i') }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div>
                <a href="{{route('archive') }}"><h2 class="text-[20px]">Public pastes</h2></a>
                <div>
                    {{-- Здесь будут публичные пасты --}}
                    @if($pastes->isEmpty())
                        <p>Нет доступных паст.</p>
                    @else
                        <ul>
                            @foreach($pastes as $paste)
                                <li>
                                    <strong>{{ $paste->title }}</strong> - 
                                    <small>{{ $paste->created_at->format('d.m.Y H:i') }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</main>

@endsection