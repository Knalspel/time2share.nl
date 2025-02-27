<x-app-layout>
    <section class="py-12">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <header class="fade-in delay-fast bg-white overflow-hidden shadow-sm sm:rounded-lg my-6 mx-4">
                <h1 class="p-6 text-gray-900 font-bold">
                    {{ __("Welcome back, ") . auth()->user()->name . ("!") }}
                </h1>
            </header>
            <section class="fade-in delay-slow bg-white overflow-hidden shadow-sm sm:rounded-lg my-2 mx-4">
                <p class="font-bold p-6 text-gray-900">Loaning Products</p>
                @foreach ($loaningProducts as $product)
                    <section class="p-2 text-gray-900 m-2">
                        <a href="{{ route('products.show', $product->id) }}" 
                            class="mx-1 inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            View Product
                        </a>
                        - {{ $product->name }} - Deadline: {{ $product->deadline }}
                    </section>
                @endforeach
            </section>
            <section class="fade-in delay-slow bg-white overflow-hidden shadow-sm sm:rounded-lg my-2 mx-4">
                <p class="font-bold p-6 text-gray-900">Return Products</p>
                @foreach ($returnProducts as $product)
                    <section class="p-2 text-gray-900 m-2">
                        <a href="{{ route('products.show', $product->id) }}" 
                        class="mx-1 inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            View Product
                        </a> - {{ $product->name }}
                    </section>
                @endforeach
            </section>
        </section>
    </section>
</x-app-layout>
