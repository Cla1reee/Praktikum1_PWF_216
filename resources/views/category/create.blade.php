<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Category Title</label>
                            <input type="text" name="title" id="title" class="w-full bg-gray-900 border border-gray-700 rounded-md text-white px-4 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20" placeholder="e.g. Work, Personal, Urgent" required autofocus>
                            @error('title')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="flex gap-3">
                            <button type="submit" class="bg-white text-gray-900 font-bold py-2 px-6 rounded hover:bg-gray-200 transition">SAVE</button>
                            <a href="{{ route('category.index') }}" class="bg-gray-700 text-gray-300 border border-gray-600 font-bold py-2 px-6 rounded hover:bg-gray-600 transition">CANCEL</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>