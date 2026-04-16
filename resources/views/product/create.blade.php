<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label>Nama Produk</label>
                        <input type="text" name="name" class="border p-2 w-full">
                        @error('name') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Jumlah (Qty)</label>
                        <input type="number" name="qty" class="border p-2 w-full">
                        @error('qty') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Harga (Price)</label>
                        <input type="number" name="price" class="border p-2 w-full">
                        @error('price') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>