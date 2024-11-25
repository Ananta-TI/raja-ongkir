<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Blog</h1>
        @if (session('success'))
            <div class="bg-green-500 text-white p-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('blog.create') }}" class="inline-block bg-purple-500 text-white px-4 py-2 rounded mb-4">
            Tambah Blog
        </a>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($blog as $item)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ Storage::url($blog->{"13_gambar"}) }}" class="w-full h-48 object-cover" alt="Gambar Blog" />
                    <div class="p-4">
                        <h2 class="text-lg font-bold">{{ $item->judul }}</h2>
                        <p class="text-gray-600 mt-2">{!!Str::limit($item->kategori, 100)!!}</p>
                        <p class="text-gray-600 mt-2">{!!Str::limit($item->status, 100)!!}</p>
                        <p class="text-gray-600 mt-2">{!!Str::limit($item->artikel, 100)!!}</p>
                        <div class="mt-4">
                            <a href="{{ route('blog.edit', $item->id) }}" class="text-blue-700 hover:underline">Edit</a>
                            <form action="{{ route('blog.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-2">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
