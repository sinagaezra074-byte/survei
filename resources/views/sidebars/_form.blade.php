@csrf

{{-- Nama Menu --}}
<div class="mb-4">
    <label class="block font-semibold mb-2">
        Nama Menu
    </label>

    <input
        type="text"
        name="nama_menu"
        value="{{ old('nama_menu', $sidebar->nama_menu ?? '') }}"
        class="w-full border rounded-lg px-4 py-2"
        placeholder="Contoh : Komentar"
        required>
</div>

{{-- Route --}}
<div class="mb-4">
    <label class="block font-semibold mb-2">
        Route
    </label>

    <input
        type="text"
        name="route"
        value="{{ old('route', $sidebar->route ?? '') }}"
        class="w-full border rounded-lg px-4 py-2"
        placeholder="Contoh : komentar.index"
        required>

    <small class="text-gray-500">
        Route yang akan dipanggil saat menu diklik.
    </small>
</div>

{{-- Urutan --}}
<div class="mb-4">
    <label class="block font-semibold mb-2">
        Urutan Menu
    </label>

    <input
        type="number"
        name="urutan"
        value="{{ old('urutan', $sidebar->urutan ?? 1) }}"
        class="w-full border rounded-lg px-4 py-2"
        min="1">
</div>

{{-- Status --}}
<div class="mb-6">
    <label class="block font-semibold mb-2">
        Status
    </label>

    <select
        name="status"
        class="w-full border rounded-lg px-4 py-2">

        <option value="1"
            {{ old('status', $sidebar->status ?? 1) == 1 ? 'selected' : '' }}>
            Aktif
        </option>

        <option value="0"
            {{ old('status', $sidebar->status ?? 1) == 0 ? 'selected' : '' }}>
            Nonaktif
        </option>

    </select>
</div>

<div class="flex justify-end">
    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

        Simpan

    </button>
</div>