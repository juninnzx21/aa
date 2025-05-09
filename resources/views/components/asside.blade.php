<div class="shrink-0 flex items-center"> <!-- Botão para abrir/fechar o menu -->
    <button id="toggleSidebar" class="p-2" style="background-color: #000;">                                                      
        <img src="/imgs/navbar.png"  style="width: 40px; height: 20px; color:#000; background-colo: #000;" alt="Menu">
    </button>
</div>

<aside id="leftbar" class="fixed top-20 left-0 h-full w-64 bg-gray-800    shadow-lg transform -translate-x-full transition-transform duration-300 z-50">
    <div class="p-4 flex justify-between items-center border-b border-gray-200 dark:border-[#3E3E3A]">
        <a href="" id="logo">
            <img class="main" src="/imgs/aa.png" alt="Logo">
        </a>
        <button id="closeSidebar">                
        </button>
    </div>
    <nav class="p-4 overflow-y-auto h-[calc(100%-60px)]">
        <ul class="space-y-3">
            <a href="games/pong" class="block px-4 py-2 colr-blue text-white hover:bg-gray-500">
                💣 Jogo: Pong
            </a>
        </ul>
    </nav>
</aside>  
