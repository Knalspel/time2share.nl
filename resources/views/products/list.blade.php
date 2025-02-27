<x-app-layout>
    <section class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <section class="bg-white shadow-sm rounded-lg divide-y">
            <form action="{{ route('products.search') }}" method="GET" class="block w-full p-5">
                <input type="text" name="query" value="{{ request('query') }}" placeholder="Search for a product" style="width: 80%;">
                <select name="category">
                    <option value="">All categories</option>
                    <option value="sport">Sport</option>
                    <option value="elektronica">Elektronica</option>
                    <option value="speelgoed">Speelgoed</option>
                    <option value="kleding">Kleding</option>
                    <option value="vervoersmiddel">Vervoersmiddel</option>
                    <option value="hobby">Hobby</option>
                    <option value="anders">Anders</option>
                </select>
                <button type="submit">Search</button>
            </form>
            @if($products->isEmpty())
                <p class="p-6 text-gray-700">No products found.</p>
            @endif
            @foreach ($products as $product)
                @if ($product->status == "AVAILABLE")
                    <section class="p-6 flex space-x-2">
                        <section class="flex-1">
                            <section class="flex justify-between items-center">
                                <section>
                                    <span class="text-gray-800">{{ $product->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $product->created_at->format('j M Y, g:i a') }}</small>
                                </section>
                                @if ($product->user->is(auth()->user()) OR auth()->user()->admin)
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('products.edit', $product)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('products.destroy', $product) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link :href="route('products.destroy', $product)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                @endif
                            </section>
                            <section style="margin-top: -15px">
                                <p class="text-xl mt-4 text-gray-900">{{ $product->name }}</p>
                                <p class="text-base text-gray-500">{{ $product->description }}</p>
                                <p class="text-base text-gray-500">Category: {{ $product->category }}</p>
                                <p class="text-base text-gray-500">Deadline: {{ $product->deadline }}</p>

                                @if (!empty($product->image)) 
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mt-4 rounded-lg lg:w-2/5 w-full">
                                @endif
                                <a href="{{ route('products.show', $product->id) }}" 
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full mx-auto text-center m-4">
                                    {{ __('View Product') }}
                                </a>
                            </section>
                        </section>
                    </section>
                @endif
            @endforeach
        </section>
    </section>
</x-app-layout>
