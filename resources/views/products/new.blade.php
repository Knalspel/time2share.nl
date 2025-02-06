<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            <section style="margin-bottom: 20px">
                <h1>Name:</h1>
                <input 
                    type="text"
                    name="name"
                    placeholder="{{ __('Name of product') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></input>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </section>
            <section style="margin-bottom: 20px">
                <h1>Description:</h1>
                <textarea
                    name="description"
                    placeholder="{{ __('Descripe your product') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
            </section>
            <h1 style="margin-bottom: -10px">Deadline:</h1>
            <input type="date" name="deadline" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            <x-primary-button class="mt-4">{{ __('Post') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>