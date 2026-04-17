<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Produk</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @if(session('success'))
                    <div class="bg-green-500 text-white p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Nama Produk</th>
                            <th class="border p-2">Qty</th>
                            <th class="border p-2">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="border p-2">{{ $product->name }}</td>
                                <td class="border p-2">{{ $product->qty }}</td>
                                <td class="border p-2 text-right">{{ number_format($product->price) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>