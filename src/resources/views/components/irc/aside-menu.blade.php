<div class="flex items-center justify-center ">
    <div class="flex w-full max-w-xs p-4 bg-white">
        <ul class="flex flex-col w-full">
            <li class="my-px">
                <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase">IRC</span>
            </li>

            <li class="my-px">
                <a href="{{ route('irc.nicks') }}"
                   class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100">
                    <span class="ml-3">Nicks</span>
                </a>
            </li>

            <li class="my-px">
                <a href="{{ route('irc.config') }}"
                   class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100">
                    <span class="ml-3">Configuración</span>
                </a>
            </li>
        </ul>
    </div>
</div>
