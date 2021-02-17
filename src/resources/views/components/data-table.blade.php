<div class="antialiased sans-serif">
	<div class="mx-auto py-6">
		<div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative" style="max-height: 405px;">
			<table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
				<thead>
					<tr class="text-left">
                        @foreach($headings as $heading)
							<th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                {{ $heading['value'] ?? '-' }}
                            </th>
                        @endforeach
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs w-52">
                            {{ __('messages.actions') }}
                        </th>
					</tr>
				</thead>
				<tbody>
                    @foreach($data as $item)
                    <tr>
                        @foreach($headings as $heading)
                        <td class="border-dashed border-t border-gray-200">
                            <span class="text-gray-700 px-6 py-3 flex items-center">
                                @if (isset($item[$heading['key']]) && is_bool($item[$heading['key']]))
                                    {{ $item[$heading['key']] ? 'Sí' : 'No' }}
                                @else
                                    {{ $item[$heading['key']] ?? '-' }}
                                @endif
                            </span>
                        </td>
                        @endforeach

                        <td class="border-dashed border-t border-gray-200 w-52">
                            @if(isset($item['updateRoute']))
                            <a href="{{ $item['updateRoute'] }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('messages.edit') }}
                            </a>
                            @endif
                            @if(isset($item['deleteRoute']))
                            <a href="{{ $item['deleteRoute'] }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('messages.delete') }}
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
