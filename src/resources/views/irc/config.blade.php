<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b">
                <div class="p-6 bg-white">
		            <h1 class="text-2xl">Configuración</h1>
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
                <div class="p-6 bg-white">
                    <x-btn-link url="{{ route('irc.config-create') }}">{{ __('messages.create') }}</x-btn-link>
                    <x-data-table
                        :data="$configList"
                        :headings="$headings"
                    ></x-data-table>
                </div>
                <div class="p-6 bg-white">
                    <x-btn-link url="{{ route('irc.index') }}">{{ __('messages.back') }}</x-btn-link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
