<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <form action="{{ route('products.search') }}" method="GET" class="block w-full" style="margin: 5px;">
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
                <p>No products found.</p>
            @endif
            @foreach ($products as $product)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $product->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $product->created_at->format('j M Y, g:i a') }}</small>
                            </div>
                        </div>
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
                        <section style="margin-top: -15px">
                            <p class="text-xl mt-4 text-gray-900">{{ $product->name }}</p>
                            <p class="text-base text-gray-500">{{ $product->description }}</p>
                            <p class="text-base text-gray-500">Category: {{ $product->category }}</p>
                            <p class="text-base text-gray-500">Deadline: {{ $product->deadline }}</p>
                            @if (!empty($product->image)) 
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @endif
                            <a href="{{ route('products.show', $product->id) }}" 
                            style="display: block; text-align: center; color: white; background-color: purple; border-radius: 15px; padding: 5px; width: 75%; margin: auto; text-decoration: none;">
                                View Product
                            </a>
                        </section>
                    </div>
                </div>
           @endforeach
        </div>
    </div>
</x-app-layout>