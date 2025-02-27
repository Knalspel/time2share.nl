<x-app-layout>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg m-5">
        <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }} - {{ $product->status }}</h1>
        <p class="text-gray-600">{{ $product->description }}</p>
        <p class="text-gray-600">Category: {{ $product->category }}</p>
        <p class="text-sm text-gray-500 mt-2">Owner: {{ $product->user->name }} - Score: {{ number_format($product->user->averageRating() ?? 0, 1) }}</p>
        <p class="text-sm text-gray-500">Contact: {{ $product->user->email }}</p>
        @if ($product->loaner_id)
            <p class="text-sm text-gray-500 mt-2">Loaner: {{ $product->loaner->name }} - Score: {{ number_format($product->loaner->averageRating() ?? 0, 1) }}</p>
            <p class="text-sm text-gray-500">Contact: {{ $product->loaner->email }}</p>
        @endif
        <p class="text-sm text-gray-500 mt-2">Deadline: {{ $product->deadline }}</p>
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

        @if ($product->status == 'RETURN' && (auth()->user()->id == $product->user_id || auth()->user()->id == $product->loaner_id))
            @php
                $hasReviewed = $product->reviews->where('reviewer_id', auth()->user()->id)->isNotEmpty();
            @endphp

            @if (!$hasReviewed)
                <div class="mt-6">
                    <h2 class="text-xl font-bold text-gray-900">Leave a review for the owner/loaner!</h2>
                    <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                        @csrf
                        <label class="block text-gray-700 text-sm font-bold mb-2">Rating (1-5):</label>
                        <input type="range" name="score" min="1" max="5" />

                        <label class="block text-gray-700 text-sm font-bold mt-2 mb-2">Comment:</label>
                        <textarea name="comment" class="border rounded-lg p-2 w-full" rows="3"></textarea>

                        <x-primary-button class="mt-4 w-full justify-center">
                            Submit Review
                        </x-primary-button>
                    </form>
                </div>
            @else
                
            @endif
        @endif
        
        @if ($product->user_id == auth()->user()->id && $product->status == 'RETURN')
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
