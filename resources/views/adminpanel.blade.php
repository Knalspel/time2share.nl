<x-app-layout>
    <section class="py-12">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <header class="fade-in delay-fast bg-white overflow-hidden shadow-sm sm:rounded-lg my-6 mx-4">
                <h1 class="p-6 text-gray-900 font-bold">
                    {{ __("Happy adminning! ") }}
                </h1>
            </header>
            <section class="flex flex-col md:flex-row gap-4 overflow-hidden sm:rounded-lg justify-between my-6 mx-4">                
                <section class="fade-in delay-slow bg-white shadow-sm sm:rounded-lg my-2 w-full md:w-1/2">
                    <h2 class="font-bold p-6 text-gray-900">Users:</h2>
                    @foreach ($users as $user)
                        <section class="flex justify-between p-2 text-gray-900 mx-4">
                            <section>
                                <p>Name: - {{ $user->name }} - Rating: {{ number_format($user->averageRating() ?? 0, 1) }}</p>
                            </section>
                            <section class="flex items-center ml-auto">
                                @if (Auth::id() != $user->id)
                                    @if ($user->blocked)
                                        <form action="{{ route('admin.unblockUser', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 text-white bg-green-500 hover:bg-green-700 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                                Unblock User
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.blockUser', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 text-white bg-red-500 hover:bg-red-700 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                                Block User
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </section>
                        </section>
                    @endforeach
                </section>
                <section class="fade-in delay-slow bg-white shadow-sm sm:rounded-lg my-2 w-full md:w-1/2">
                    <h2 class="font-bold p-6 text-gray-900">Products:</h2>
                    @foreach ($products as $product)
                        <section class="flex justify-between p-2 text-gray-900 m-2">
                            <section>
                                <a href="{{ route('products.show', $product->id) }}" 
                                   name="view_product_button" class="mx-1 inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    View Product
                                </a> 
                                - {{ $product->name }} - {{ $product->status }}
                            </section>
                            <section class="ml-auto relative">
                                <x-dropdown align="right">
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
                            </section>
                        </section>
                    @endforeach
                </section>
            </section>
        </section>
    </section>
</x-app-layout>
