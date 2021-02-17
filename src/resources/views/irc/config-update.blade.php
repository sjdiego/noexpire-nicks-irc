<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @csrf
                <div class="p-6 bg-white">
                    <h1 class="text-2xl">Editar configuración</h1>
                </div>
                @if (session('error'))
                <div class="p-6 bg-white">
                    <x-alert type="danger" title="Error" message="{{ session('error') }}"></x-alert>
                </div>
                @endif
                @if (session('success'))
                <div class="p-6 bg-white">
                    <x-alert type="success" title="Ok" message="{{ session('success') }}"></x-alert>
                </div>
                @endif
                <input type="hidden" name="key" value="{{ $config->key }}">
                <div class="p-6 bg-white">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="key">
                                {{ __('messages.key') }}
                            </label>
                            <input autocomplete="off" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                   id="key" type="text" placeholder="clave" value="{{ $config->key }}" required disabled>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="value">
                                {{ __('messages.value') }}
                            </label>
                            <input autocomplete="off" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3"
                                   id="value" type="text" name="value" placeholder="Valor" value="{{ $config->value }}" required>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-white">
                    <x-button>{{ __('messages.save') }}</x-button>
                    <x-btn-link url="{{ route('irc.config') }}">{{ __('messages.back') }}</x-btn-link>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
