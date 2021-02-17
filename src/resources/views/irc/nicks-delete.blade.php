<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @csrf
                <input type="hidden" name="id" value="{{ $nick->id }}">
                <div class="p-6 bg-white">
                    <h1 class="text-2xl">Confirmar eliminación de Nick {{ $nick->name }}</h1>
                </div>
                <div class="p-6 bg-white">
                    <x-button>{{ __('messages.delete') }}</x-button>
                    <x-btn-link url="{{ route('irc.nicks') }}">{{ __('messages.back') }}</x-btn-link>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
