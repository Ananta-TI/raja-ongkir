<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Tambah Blog</h1>
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium">Judul</label>
                <input type="text" name="13_judul" class="mt-1 block w-full border-gray-300 rounded-md"/>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Kategori</label>
                <select type="option" name="13_kategori" class="mt-1 block w-full border-gray-300 rounded-md">
                <option>Berita</option>
                <option>Pengumuman</option>
                <option>Informasi</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Status</label>
                <input type="radio" name="13_status"> On
                <input type="radio" name="13_status"> Off
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Artikel</label>
                <textarea name="13_artikel" id="editor" rows="5" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Gambar</label>
                <input type="file" name="13_gambar" class="mt-1 block w-full" accept="image/*" />
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
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
