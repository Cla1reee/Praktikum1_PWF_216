<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Produk: {{ $product->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('product.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label>Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="border p-2 w-full">
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Jumlah (Qty)</label>
                        <input type="number" name="qty" value="{{ old('qty', $product->qty) }}" class="border p-2 w-full">
                        @error('qty') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Harga (Price)</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="border p-2 w-full">
                        @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex gap-2 mt-4">
                        <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold px-4 py-2 rounded shadow">
                            Perbarui Data
                        </button>

                        <a href="{{ route('product.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-4 py-2 rounded shadow">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>