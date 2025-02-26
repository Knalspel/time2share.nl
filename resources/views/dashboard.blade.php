<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-4">
                <div class="p-6 text-gray-900 font-bold">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2 mx-4">
                <p class="font-bold p-6 text-gray-900">Loaning Products</p>
                @foreach ($loaningProducts as $product)
                    <div class="p-2 text-gray-900 my-2 mx-4">{{ $product->name }} -
                        <a href="{{ route('products.show', $product->id) }}" 
                           class="mx-1 inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            View Product
                        </a>
                    </div>
                @endforeach
            </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2 mx-4">
                    <p class="font-bold p-6 text-gray-900">Return Products</p>
                    @foreach ($returnProducts as $product)
                        <div class="p-2 text-gray-900 my-2 mx-4">{{ $product->name }} -
                            <a href="{{ route('products.show', $product->id) }}" 
                            class="mx-1 inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                View Product
                            </a>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
