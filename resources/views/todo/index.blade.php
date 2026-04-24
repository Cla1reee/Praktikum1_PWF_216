<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="mb-6">
                        <a href="{{ route('todo.create') }}" class="bg-white text-gray-900 font-bold py-2 px-4 rounded hover:bg-gray-200 transition">
                            CREATE
                        </a>
                    </div>
                    
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-700/50 text-gray-400 text-xs uppercase tracking-wider border-b border-gray-600">
                                <th class="p-4 font-medium">TITLE</th>
                                <th class="p-4 font-medium">CATEGORY</th>
                                <th class="p-4 font-medium">STATUS</th>
                                <th class="p-4 font-medium text-center w-40">ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300 text-sm">
                            @forelse ($todos as $todo)
                                <tr class="border-b border-gray-700 hover:bg-gray-700/25 transition">
                                    <td class="p-4">{{ $todo->title }}</td>
                                    <td class="p-4">{{ $todo->category ? $todo->category->title : '' }}</td>
                                    <td class="p-4">
                                        @if($todo->is_completed)
                                            <span class="px-2 py-1 bg-green-900/50 text-green-400 text-xs rounded border border-green-800">Completed</span>
                                        @else
                                            <span class="px-2 py-1 bg-blue-900/50 text-blue-400 text-xs rounded border border-blue-800">Ongoing</span>
                                        @endif
                                    </td>
                                    <td class="p-4 flex justify-center gap-4">
                                        <form action="{{ route('todo.update', $todo->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="title" value="{{ $todo->title }}">
                                            <input type="hidden" name="category_id" value="{{ $todo->category_id }}">
                                            <input type="hidden" name="is_completed" value="{{ $todo->is_completed ? 0 : 1 }}">
                                            <button type="submit" class="text-green-500 hover:text-green-400 transition">
                                                {{ $todo->is_completed ? 'Undo' : 'Complete' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" onsubmit="return confirm('Hapus Todo ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400 transition">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-4 text-center text-gray-500 italic">Belum ada tugas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>