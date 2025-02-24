<x-app-layout>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
        <p class="text-gray-600">{{ $product->description }}</p>
        <p class="text-sm text-gray-500">Category: {{ $product->category }}</p>
        <p class="text-sm text-gray-500">Deadline: {{ $product->deadline }}</p>

        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mt-4 rounded-lg">
        @endif

        @if ($product->user_id !== auth()->user()->id)
            <form action="{{ route('products.loan', $product->id) }}" method="POST">
                @csrf
                @method('PATCH')
                    <button type="submit" style="color: white; background-color: purple; border-radius: 15px; padding: 5px; width: 75%; margin: auto;" class="block">
                        Loan
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
                <button type="submit" style="color: white; background-color: purple; border-radius: 15px; padding: 5px; width: 75%; margin: auto;" class="block">
                    Submit Review
                </button>
            </form>
            <form action="{{ route('products.return', $product->id) }}" method="POST">
                @csrf
                @method('PATCH')
                    <button type="submit" style="color: white; background-color: purple; border-radius: 15px; padding: 5px; width: 75%; margin: auto;" class="block">
                        Item has been returned
                    </button>
            </form>   
        @endif
    </div>
</x-app-layout>
