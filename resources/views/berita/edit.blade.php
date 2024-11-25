<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Edit Berita</h1>
        <form action="{{ route('berita.update', $beritum->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium">Judul</label>
                <input type="text" name="judul" value="{{ $beritum->judul }}" class="mt-1 block w-full border-gray-300 rounded-md"/>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Isi Berita</label>
                <textarea name="isi_berita" id="editor" rows="5" class="mt-1 block w-full border-gray-300 rounded-md">{{ $beritum->isi_berita }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Gambar</label>
                <input type="file" name="gambar" class="mt-1 block w-full" accept="image/*" />
                @if ($beritum->gambar)
                    <img src="{{ Storage::url($beritum->gambar) }}" class="h-48 mt-2" alt="Gambar Berita" />
                @endif
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>
