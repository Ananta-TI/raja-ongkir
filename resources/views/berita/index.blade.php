<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Manajemen Berita</h1>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4" id="btn-tambah">Tambah Berita</button>
        <table class="w-full table-auto bg-white shadow-md rounded mb-4">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Judul</th>
                    <th class="py-3 px-6 text-left">Isi Berita</th>
                    <th class="py-3 px-6 text-left">Gambar</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light" id="berita-table-body"></tbody>
        </table>
    </div>

    <!-- Modal untuk Input Berita -->
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden" id="beritaModal">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <form id="beritaForm">
                <h2 class="text-xl font-semibold mb-4" id="beritaModalLabel">Tambah Berita</h2>
                <input type="hidden" id="berita_id" name="berita_id">
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700">Judul</label>
                    <input type="text" id="judul" name="judul" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="isi_berita" class="block text-gray-700">Isi Berita</label>
                    <textarea id="isi_berita" name="isi_berita" class="w-full px-4 py-2 border rounded-md" rows="3" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="gambar" class="block text-gray-700">Gambar</label>
                    <input type="file" id="gambar" name="gambar" class="w-full px-4 py-2 border rounded-md">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" id="btn-close">Tutup</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded" id="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Load data
        loadData();

        // Show modal untuk tambah berita
        $('#btn-tambah').click(function() {
            $('#berita_id').val('');
            $('#beritaForm')[0].reset();
            $('#beritaModalLabel').text('Tambah Berita');
            $('#beritaModal').removeClass('hidden');
        });

        // Tutup modal
        $('#btn-close').click(function() {
            $('#beritaModal').addClass('hidden');
        });

        // Simpan berita (tambah atau update)
        $('#beritaForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = $('#berita_id').val();

            if (id){
                formData.append('_method', 'PUT')
            }
            const url = id ? `/api/berita/${id}` : '/api/berita';
            const method = id ? 'POST' : 'POST';


            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#beritaModal').addClass('hidden');
                    loadData();
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan!');
                }
            });
        });

        // Load data ke tabel
        function loadData() {
            $.ajax({
                url: '/api/berita',
                type: 'GET',
                success: function(data) {
                    let rows = '';
                    data.forEach(function(berita) {
                        rows += `
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">${berita.id}</td>
                                <td class="py-3 px-6 text-left">${berita.judul}</td>
                                <td class="py-3 px-6 text-left">${berita.isi_berita}</td>
                                <td class="py-3 px-6 text-left">${berita.gambar ? `<img src="Storage/${berita.gambar}" class="w-24 h-auto" />` : ''}</td>
                                <td class="py-3 px-6 text-center">
                                    <button class="bg-yellow-500 text-white px-4 py-2 rounded btn-edit" data-id="${berita.id}">Edit</button>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded btn-delete" data-id="${berita.id}">Hapus</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#berita-table-body').html(rows);
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat memuat data!');
                }
            });
        }

        // Edit berita
        $(document).on('click', '.btn-edit', function() {
            const id = $(this).data('id');
            $.ajax({
                url: `/api/berita/${id}`,
                type: 'GET',
                success: function(data) {
                    $('#berita_id').val(data.id);
                    $('#judul').val(data.judul);
                    $('#isi_berita').val(data.isi_berita);
                    $('#beritaModalLabel').text('Edit Berita');
                    $('#beritaModal').removeClass('hidden');
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat memuat data!');
                }
            });
        });

        // Hapus berita
        $(document).on('click', '.btn-delete', function() {
            const id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
                $.ajax({
                    url: `/api/berita/${id}`,
                    type: 'DELETE',
                    success: function(data) {
                        loadData();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menghapus data!');
                    }
                });
            }
        });
    });
    </script>
</x-app-layout>

