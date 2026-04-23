<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Produk</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                
                @if(session('success'))
                    <div class="bg-green-500 text-white p-3 rounded mb-4 font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-4 flex justify-end">
                    <a href="{{ route('product.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Tambah Produk Baru
                    </a>
                </div>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-3 text-left">Nama Produk</th>
                            <th class="border border-gray-300 p-3 text-center">Qty</th>
                            <th class="border border-gray-300 p-3 text-right">Harga</th>
                            <th class="border border-gray-300 p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 p-3">{{ $product->name }}</td>
                                <td class="border border-gray-300 p-3 text-center">{{ $product->qty }}</td>
                                <td class="border border-gray-300 p-3 text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 p-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        @can('update', $product)
                                            <x-edit-button :url="route('product.edit', $product->id)" />
                                        @endcan

                                        @can('delete', $product)
                                            <x-delete-button :action="route('product.destroy', $product->id)" />
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border border-gray-300 p-4 text-center text-gray-500 italic">
                                    Belum ada data produk di dalam database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</x-app-layout>