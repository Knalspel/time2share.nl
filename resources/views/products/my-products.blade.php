<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <button onclick="window.location.href='{{route('new')}}'"style="color: white; background-color: purple; border-radius: 15px; padding: 5px; width: 75%; margin: auto;" class="block">Register new product</button>
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($products as $product)
                @if ($product->user_id == auth()->user()->id)
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
                            <section style="margin-top: -15px">
                                <p class="text-xl mt-4 text-gray-900">{{ $product->name }}</p>
                                <p class="text-base text-gray-500">{{ $product->description }}</p>
                                <p class="text-base text-gray-500">Category: {{ $product->category }}</p>
                                <p class="text-base text-gray-500">Deadline: {{ $product->deadline }}</p>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">                            </section>
                        </div>
                    </div>
                @endif
           @endforeach
        </div>
    </div>
</x-app-layout>