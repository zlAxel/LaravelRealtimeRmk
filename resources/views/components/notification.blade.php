{{-- ? Inicio de la notificación --}}
<div class="absolute right-8 translate-x-[150%] transition-transform duration-700" id="notification">
    <div class="bg-white w-full px-5 py-3.5 rounded-lg shadow hover:shadow-xl max-w-sm transform hover:-translate-y-[0.125rem] transition duration-100 ease-linear">
        <div class="w-full flex items-center justify-between">
            <span class="font-medium text-sm text-slate-400">Nueva notificación</span>
            <button id="close_notification" class="-mr-1 bg-slate-100 hover:bg-slate-200 text-slate-400 hover:text-slate-600 h-5 w-5 rounded-full flex justify-center items-center">
                <svg class="h-2 w-2 fill-current items-center" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
            </button>
        </div>
        <div class="flex items-center mt-2 rounded-lg px-1 py-1 cursor-pointer">
            <div class="relative flex flex-shrink-0 items-end">
                <svg class="h-16 w-16 rounded-full" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#FFFFFF;" d="M256,508C117.04,508,4,394.96,4,256S117.04,4,256,4s252,113.04,252,252S394.96,508,256,508z"></path> <path style="fill:#D6D6D6;" d="M256,8c136.752,0,248,111.248,248,248S392.752,504,256,504S8,392.752,8,256S119.248,8,256,8 M256,0 C114.608,0,0,114.608,0,256s114.608,256,256,256s256-114.608,256-256S397.392,0,256,0L256,0z"></path> <g> <ellipse style="fill:#0BA4E0;" cx="256" cy="175.648" rx="61.712" ry="60.48"></ellipse> <path style="fill:#0BA4E0;" d="M362.592,360.624c0-57.696-47.728-104.464-106.592-104.464s-106.592,46.768-106.592,104.464H362.592 z"></path> </g> </g></svg>
                <span class="absolute h-4 w-4 rounded-full bottom-0 right-0 border-2 border-white" id="dot_state"></span>
            </div>
            <div class="ml-3 pl-1 pr-10">
                <span class="font-semibold tracking-tight text-xs" id="name"></span>
                {{-- <span class="text-xs leading-none opacity-50">reacted to your comment:</span> --}}
                <p class="text-xs leading-4 pt-2 opacity-70" id="message"></p>
                <span class="text-[10.5px] font-medium leading-4 opacity-75" id="state"></span>
            </div>
        </div>
    </div>
</div>
{{-- ? Final de la notificación --}}