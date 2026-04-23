<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 border border-gray-700 shadow-xl rounded-xl overflow-hidden">
                
                <div class="p-6 border-b border-gray-700 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('product.index') }}" class="text-gray-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-2xl font-bold text-white tracking-tight">Product Detail</h2>
                            <p class="text-sm text-gray-400 mt-1">Viewing product #{{ $product->id }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        @can('update', $product)
                            <x-edit-button :url="route('product.edit', $product->id)" />
                        @endcan

                        @can('delete', $product)
                            <x-delete-button :action="route('product.destroy', $product->id)" />
                        @endcan
                    </div>
                </div>

                <div class="flex flex-col text-sm text-gray-300">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-6 border-b border-gray-700/50 hover:bg-gray-800/50 transition-colors">
                        <div class="font-medium text-gray-400">Product Name</div>
                        <div class="sm:col-span-2 font-bold text-white">{{ $product->name }}</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 p-6 border-b border-gray-700/50 hover:bg-gray-800/50 transition-colors items-center">
                        <div class="font-medium text-gray-400">Quantity</div>
                        <div class="sm:col-span-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-900/50 text-green-400 border border-green-800">
                                {{ $product->qty }} In Stock
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 p-6 border-b border-gray-700/50 hover:bg-gray-800/50 transition-colors">
                        <div class="font-medium text-gray-400">Price</div>
                        <div class="sm:col-span-2 font-bold text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 p-6 border-b border-gray-700/50 hover:bg-gray-800/50 transition-colors items-center">
                        <div class="font-medium text-gray-400">Owner</div>
                        <div class="sm:col-span-2 flex items-center gap-3 text-white font-medium">
                            <div class="h-8 w-8 rounded-full bg-indigo-900 flex items-center justify-center text-indigo-300 font-bold border border-indigo-700">
                                {{ strtoupper(substr($product->user->name ?? 'U', 0, 1)) }}
                            </div>
                            {{ $product->user->name ?? 'Unknown User' }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 p-6 border-b border-gray-700/50 hover:bg-gray-800/50 transition-colors">
                        <div class="font-medium text-gray-400">Created At</div>
                        <div class="sm:col-span-2 text-gray-300">{{ $product->created_at->format('d M Y, H:i') }}</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 p-6 hover:bg-gray-800/50 transition-colors">
                        <div class="font-medium text-gray-400">Updated At</div>
                        <div class="sm:col-span-2 text-gray-300">{{ $product->updated_at->format('d M Y, H:i') }}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>