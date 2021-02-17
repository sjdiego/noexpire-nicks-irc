<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
		            <h1 class="text-2xl">IRC Realm</h1>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:grid grid-cols-6 lg:grid-cols-8 gap-4">
                        <div class="col-start-1 col-end-3">
                            <x-irc.aside-menu></x-irc.aside-menu>
                        </div>
                        <div class="col-start-3 col-end-7 lg:col-end-9">
                            <div class="flex items-center text-gray-800">
                                <div class="p-4 w-full">
                                    <div class="grid grid-cols-12 gap-4">
                                        <x-info-card title="Total" text="{{ $nickCount }}"></x-info-card>
                                        @if($lastNick)
                                        <x-info-card title="Last" text="{{ $lastNick->name }}"></x-info-card>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
