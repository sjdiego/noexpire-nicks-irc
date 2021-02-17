<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @csrf
                <input type="hidden" name="id" value="{{ $nick->id }}">
                <div class="p-6 bg-white">
                    <h1 class="text-2xl">Editar nick</h1>
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
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="name">
                                {{ __('messages.name') }}
                            </label>
                            <input autocomplete="off" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                   id="name" name="name" type="text" placeholder="Juan" value="{{ $nick->name }}" required>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="password">
                                {{ __('messages.password') }}
                            </label>
                            <input autocomplete="off" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3"
                                   id="password" type="password" name="password" placeholder="******************" value="{{ $nick->password }}" required>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-2">
                        <div class="md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                   for="grid-state">
                                {{ __('messages.active') }}
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded"
                                        id="is_active" name="is_active" required>
                                    <option value="1" {{ $nick->is_active ? 'selected' : '' }}>{{ __('messages.yes') }}</option>
                                    <option value="0" {{ $nick->is_active ? '' : 'selected' }}>{{ __('messages.no') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-white">
                    <x-button>{{ __('messages.save') }}</x-button>
                    <x-btn-link url="{{ route('irc.nicks') }}">{{ __('messages.back') }}</x-btn-link>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
