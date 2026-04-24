<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="mb-6">
                        <a href="{{ route('category.create') }}" class="bg-white text-gray-900 font-bold py-2 px-4 rounded hover:bg-gray-200 transition">
                            CREATE
                        </a>
                    </div>
                    
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-700/50 text-gray-400 text-xs uppercase tracking-wider border-b border-gray-600">
                                <th class="p-4 font-medium">TITLE</th>
                                <th class="p-4 font-medium">TODO</th>
                                <th class="p-4 font-medium text-center w-32">ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300 text-sm">
                            @forelse ($categories as $category)
                                <tr class="border-b border-gray-700 hover:bg-gray-700/25 transition">
                                    <td class="p-4">{{ $category->title }}</td>
                                    <td class="p-4">{{ $category->todos_count }}</td>
                                    <td class="p-4 flex justify-center">
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400 transition">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-4 text-center text-gray-500 italic">Belum ada kategori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>