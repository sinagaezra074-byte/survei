@extends('layouts.admin_utama')

@section('title', 'Kelola Field')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold">
            Kelola Field
        </h1>

        <p class="text-gray-500">
            Menu :
            <span class="font-semibold">
                {{ $sidebar->nama_menu }}
            </span>
        </p>

    </div>

    <div class="flex gap-3">

        <a href="{{ route('sidebars.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg shadow">

            ← Kembali

        </a>

        <a href="{{ route('sidebar-fields.create', $sidebar->id) }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">

            + Tambah Field

        </a>

    </div>

</div>

@if(session('success'))

<div class="mb-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-xl shadow-lg overflow-hidden">

    <table class="min-w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="px-5 py-4">No</th>
                <th class="px-5 py-4">Nama Field</th>
                <th class="px-5 py-4">Tipe</th>
                <th class="px-5 py-4">Required</th>
                <th class="px-5 py-4">Urutan</th>
                <th class="px-5 py-4">Status</th>
                <th class="px-5 py-4 text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($fields as $field)

            <tr class="border-t hover:bg-gray-50">

                <td class="px-5 py-4">
                    {{ $loop->iteration }}
                </td>

                <td class="px-5 py-4 font-semibold">
                    {{ $field->nama_field }}
                </td>

                <td class="px-5 py-4">
                    {{ ucfirst($field->tipe_field) }}
                </td>

                <td class="px-5 py-4">
                    {{ $field->required ? 'Ya' : 'Tidak' }}
                </td>

                <td class="px-5 py-4">
                    {{ $field->urutan }}
                </td>

                <td class="px-5 py-4">

                    @if($field->status)

                    <span class="inline-block bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                        Aktif
                    </span>

                    @else

                    <span class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm">
                        Nonaktif
                    </span>

                    @endif

                </td>

                <td class="px-5 py-4">

                    <div class="flex justify-center gap-2">

                        <a href="{{ route('sidebar-fields.show', $field->id) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg">

                            Detail

                        </a>

                        <a href="{{ route('sidebar-fields.edit', $field->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">

                            Edit

                        </a>

                        <form action="{{ route('sidebar-fields.destroy', $field->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus field ini?')"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg">

                                Hapus

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" class="text-center py-8 text-gray-500">

                    Belum ada Field.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection