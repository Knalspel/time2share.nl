<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <x-primary-button onclick="window.location.href='{{ route('new') }}'" class="w-full mx-auto text-center">
            {{ __('Register new product') }}
        </x-primary-button>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($products as $product)
                @if ($product->user_id == auth()->user()->id)
                    <div class="p-6 flex space-x-2">
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $product->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $product->created_at->format('j M Y, g:i a') }}</small>
                                    
                                    <!-- Stylish Status Bubble -->
                                    <small class="text-sm ml-2 
                                        @if($product->status == 'AVAILABLE') bg-blue-500 text-white
                                        @elseif($product->status == 'LOANING') bg-yellow-400 text-gray-800
                                        @elseif($product->status == 'RETURN') bg-yellow-600 text-gray-800
                                        @elseif($product->status == 'RETURNED') bg-pink-500 text-white
                                        @endif
                                        px-3 py-1 rounded-full">
                                        {{ ucfirst($product->status) }}
                                    </small>
                                </div>
                                @if ($product->user->is(auth()->user()))
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
                            </div>

                            <section style="margin-top: -15px">
                                <p class="text-xl mt-4 text-gray-900">{{ $product->name }}</p>
                                <p class="text-base text-gray-500">{{ $product->description }}</p>
                                <p class="text-base text-gray-500">Category: {{ $product->category }}</p>
                                <p class="text-base text-gray-500">Deadline: {{ $product->deadline }}</p>

                                @if (!empty($product->image)) 
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="my-4 rounded-lg w-2/5">
                                @endif

                                <a href="{{ route('products.show', $product->id) }}" 
                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    View Product
                                </a>
                            </section>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
