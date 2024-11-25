<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('pesan_saran.update',$pesanSaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <input type="text" name="nama" value="{{ old('nama', $pesanSaran->nama) }}"
                   class="block w-full border-gray-300 rounded-md" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />

            <!-- Email -->
            <input type="email" name="email" value="{{ old('email', $pesanSaran->email) }}"
                   class="block w-full mt-4 border-gray-300 rounded-md" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <!-- Pesan -->
            <textarea name="pesan"
                      class="block w-full mt-4 border-gray-300 rounded-md">{{ old('pesan', $pesanSaran->pesan) }}</textarea>
            <x-input-error :messages="$errors->get('pesan')" class="mt-2" />

            <!-- Tombol submit -->
            <x-primary-button class="mt-4">Simpan Perubahan</x-primary-button>
        </form>
    </div>
</x-app-layout>
