@csrf

<input
    type="hidden"
    name="sidebar_id"
    value="{{ $sidebar->id }}">

{{-- Nama Field --}}
<div class="mb-4">

    <label class="block font-semibold mb-2">
        Nama Field
    </label>

    <input
        type="text"
        name="nama_field"
        value="{{ old('nama_field', $field->nama_field ?? '') }}"
        class="w-full border rounded-lg px-4 py-2"
        placeholder="Contoh : Judul"
        required>

</div>

{{-- Tipe Field --}}
<div class="mb-4">

    <label class="block font-semibold mb-2">
        Tipe Field
    </label>

    <select
        name="tipe_field"
        class="w-full border rounded-lg px-4 py-2"
        required>

        <option value="">-- Pilih Tipe --</option>

        <option value="text">Text</option>
        <option value="textarea">Textarea</option>
        <option value="number">Number</option>
        <option value="email">Email</option>
        <option value="password">Password</option>
        <option value="date">Date</option>
        <option value="datetime">Datetime</option>
        <option value="time">Time</option>
        <option value="image">Upload Gambar</option>
        <option value="file">Upload File</option>
        <option value="pdf">Upload PDF</option>
        <option value="select">Dropdown</option>
        <option value="radio">Radio Button</option>
        <option value="checkbox">Checkbox</option>

    </select>

</div>

{{-- Placeholder --}}
<div class="mb-4">

    <label class="block font-semibold mb-2">
        Placeholder
    </label>

    <input
        type="text"
        name="placeholder"
        value="{{ old('placeholder', $field->placeholder ?? '') }}"
        class="w-full border rounded-lg px-4 py-2">

</div>

{{-- Default Value --}}
<div class="mb-4">

    <label class="block font-semibold mb-2">
        Default Value
    </label>

    <input
        type="text"
        name="default_value"
        value="{{ old('default_value', $field->default_value ?? '') }}"
        class="w-full border rounded-lg px-4 py-2">

</div>

{{-- Urutan --}}
<div class="mb-4">

    <label class="block font-semibold mb-2">
        Urutan
    </label>

    <input
        type="number"
        name="urutan"
        value="{{ old('urutan', $field->urutan ?? 1) }}"
        class="w-full border rounded-lg px-4 py-2">

</div>

{{-- Required --}}
<div class="mb-4">

    <label class="flex items-center gap-2">

        <input
            type="checkbox"
            name="required"
            value="1"
            {{ old('required', $field->required ?? false) ? 'checked' : '' }}>

        Field Wajib Diisi

    </label>

</div>

{{-- Status --}}
<div class="mb-6">

    <label class="block font-semibold mb-2">
        Status
    </label>

    <select
        name="status"
        class="w-full border rounded-lg px-4 py-2">

        <option value="1">Aktif</option>
        <option value="0">Nonaktif</option>

    </select>

</div>

<div class="flex justify-end">

    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

        Simpan

    </button>

</div>