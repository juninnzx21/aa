<header class="fixed top-0 left-0 w-full bg-gray-800 z-50 text-sm mb-6">
    <div id="fixed-header">
        <div id="header" class="flex justify-between items-center px-4 py-2">                 
            @include('components.asside')
                <!-- ESQUERDA -->
                <div class="flex items-center gap-4">
                    <div class="left-bar-action">
                            <a href="/">
                                <img alt="menu" style="width: 50%; height: 50%;" src="/imgs/aa.png">
                            </a>
                    </div>
                </div>

                <!-- DIREITA -->
                @if (Route::has('login'))
                    <div class="flex items-center gap-2">
                        @auth
                            <a href="{{ url('/games/pong') }}" class="text-sm px-4 py-1 border rounded border-gray-300 dark:border-[#3E3E3A] text-[#1b1b18] dark:text-[#EDEDEC] hover:border-gray-500">
                                Game
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                Entrar
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                    <button class="text-sm px-4 py-1 rounded bg-[#f12c4c] text-white">
                                        Cadastre-se
                                    </button>
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>          
      
 </header>