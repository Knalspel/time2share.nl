<x-app-layout>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg m-5">
        <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }} - {{ $product->status }}</h1>
        <p class="text-gray-600">{{ $product->description }}</p>
        <p class="text-gray-600">Category: {{ $product->category }}</p>
        <p class="text-sm text-gray-500">Owner: {{ $product->user->name }}</p>
        <p class="text-sm text-gray-500">Contact: {{ $product->user->email }}</p>
        <p class="text-sm text-gray-500">Deadline: {{ $product->deadline }}</p>

        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mt-4 rounded-lg w-2/5">
        @endif

        @if ($product->user_id !== auth()->user()->id and $product->status == "AVAILABLE")
            <form action="{{ route('products.loan', $product->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full mx-auto text-center m-4">
                    {{ __('Loan') }}
                </button>
            </form>   
        @endif
        @if ($product->user_id == auth()->user()->id && $product->status == 'RETURN')
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="account_id" value="{{ $product->user_id }}">
                <section style="margin-bottom: 20px">
                    <h1>Name:</h1>
                    <input 
                        type="text"
                        name="title"
                        placeholder="{{ __('Title (Optional)') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >
                </section>
                <section style="margin-bottom: 20px">
                    <h1>Text:</h1>
                    <textarea
                        name="text"
                        placeholder="{{ __('Tell about your experience (Optional)') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></textarea>
                </section>
                <section style="margin-bottom: 20px">
                    <h1>Rating:</h1>
                    <input 
                        type="range"
                        name="score"
                        min="1" max="5"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >
                </section>
                <button type="submit" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full mx-auto text-center">
                    Submit Review
                </button>
            </form>
            <form action="{{ route('products.return', $product->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full mx-auto text-center m-4">
                    Item has been returned
                </button>
            </form>   
        @endif
    </div>
</x-app-layout>
