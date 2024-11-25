<x-app-layout>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($berita as $ber)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ Storage::url($ber->gambar) }}" class="w-full h-48 object-cover" alt="Gambar Berita" />
                    <div class="p-4">
                        <h2 class="text-lg font-bold">{{ $ber->judul }}</h2>
                        <p class="text-gray-600 mt-2">{!! Str::limit($ber->isi_berita, 100) !!}</p>
                    </div>
                </div>
            @endforeach
</x-app-layout>
