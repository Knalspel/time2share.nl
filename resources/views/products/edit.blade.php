<x-app-layout>
    <article class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <section style="margin-bottom: 20px">
                <h1>Name:</h1>
                <input 
                    type="text"
                    name="name"
                    value="{{ old('name', $product->name) }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </section>
            <section style="margin-bottom: 20px">
                <h1>Description:</h1>
                <textarea
                    name="description"
                    value="{{ old('description', $product->description) }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ old('description', $product->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </section>
            <section style="margin-bottom: 20px">
                <h1>Category:</h1>
                <select name="category" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="sport">Sport</option>
                    <option value="elektronica">Elektronica</option>
                    <option value="speelgoed">Speelgoed</option>
                    <option value="kleding">Kleding</option>
                    <option value="vervoersmiddel">Vervoersmiddel</option>
                    <option value="hobby">Hobby</option>
                    <option value="anders">Anders</option>
                </select>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </section>
            <section style="margin-bottom: 20px">
                <h1>Image:</h1>
                <input type="file" name="image">
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </section>
            <h1>Deadline:</h1>
            <input type="date" value="{{ old('date', date('Y-m-d')) }}" name="deadline" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            <a href="{{ route('products.index') }}">{{ __('Cancel') }}</a>
        </form>
    </article>
</x-app-layout>