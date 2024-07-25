{{-- Шаблон header'а --}}

<header class="h-[50px] w-[100%] m-0 p-0 bg-[#023859] text-white">
    <div class="max-w-[1340px] m-auto flex h-[100%] justify-between items-center">
        <a href="{{route('home') }}">
            <span class="h-[100%] text-[45px] ">PASTEBIN</span>
        </a>
        <div class="flex gap-5 items-center">
            <a href="/api">API</a>
            <a href="{{route('home') }}" class="bg-green-600 p-[3px] rounded-md">+ Paste</a>
            <form action="{{ route('search') }}" method="get" class="flex gap-[5px]">
                <input type="text" name="search" id="" class="text-black" placeholder="Введите название...">
                <button type="submit" class="bg-white p-[3px] rounded-md text-black">Поиск</button>
            </form>
        </div>
        <div>
            <nav>
                <ul class="flex gap-[10px]">
                    @if(Auth::check())
                        <li>Welcome, {{ Auth::user()->name }}</li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>   
</header>