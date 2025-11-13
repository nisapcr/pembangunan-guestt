<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Proyek</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-6">

  <div class="w-full max-w-3xl bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-8 py-5">
      <h1 class="text-3xl font-bold flex items-center gap-2">
        ✏️ Edit Data Proyek
      </h1>
      <p class="text-blue-100 text-sm mt-1">
        Perbarui informasi proyek daerah dengan data terbaru
      </p>
    </div>

    <!-- Body -->
    <div class="p-8">
      <a href="/proyek" class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1 mb-6">
        ← Kembali ke Daftar Proyek
      </a>

      <form action="/proyek/update" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Kode Proyek -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Proyek</label>
          <input type="text" name="kode_proyek" value="012"
            class="w-full border border-gray-300 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Nama Proyek -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Proyek</label>
          <input type="text" name="nama_proyek" value="masjid"
            class="w-full border border-gray-300 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Tahun -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun</label>
          <input type="text" name="tahun" value="2025"
            class="w-full border border-gray-300 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Lokasi -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
          <input type="text" name="lokasi" value="jakarta"
            class="w-full border border-gray-300 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Anggaran -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Anggaran</label>
          <div class="flex items-center">
            <span class="px-3 py-2 bg-gray-100 border border-gray-300 rounded-l-xl text-gray-600">Rp</span>
            <input type="number" name="anggaran" value="7654000000000"
              class="w-full border border-gray-300 rounded-r-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>

        <!-- Sumber Dana -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Sumber Dana</label>
          <select name="sumber_dana"
            class="w-full border border-gray-300 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option selected>APBD</option>
            <option>APBN</option>
            <option>Donasi</option>
            <option>Lainnya</option>
          </select>
        </div>

        <!-- Deskripsi (full width) -->
        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
          <textarea name="deskripsi" rows="3"
            class="w-full border border-gray-300 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">progres</textarea>
        </div>

        <!-- Tombol Update -->
        <div class="md:col-span-2 flex justify-end mt-4">
          <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-8 rounded-xl shadow transition-all duration-200 flex items-center gap-2">
            💾 Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
