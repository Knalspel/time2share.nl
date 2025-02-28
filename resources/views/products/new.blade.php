<x-app-layout>
    <article class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <section class="product_input">
                <label for="name" >Name*:</label>
                <input 
                    type="text"
                    id="name"
                    name="name"
                    placeholder="{{ __('Name of product') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </section>
            <section class="product_input">
                <label for="description">Description:</label>
                <textarea
                    name="description"
                    id="description"
                    placeholder="{{ __('Descripe your product') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </section>
            <section class="product_input">
                <label for="category">Category*:</label>
                <select id="category" name="category" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
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
            <section class="product_input">
                <label for="image">Image:</label>
                <input id="image" type="file" name="image">
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </section>
            <label for="deadline" style="margin-bottom: -10px">Deadline*:</label>
            <input id="deadline" type="date" name="deadline" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
            <x-primary-button name="post button" class="mt-4">
                {{ __('Post') }}
            </x-primary-button>
        </form>
    </article>
</x-app-layout>