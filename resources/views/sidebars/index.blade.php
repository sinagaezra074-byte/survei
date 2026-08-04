@extends('layouts.admin_utama')

@section('title', 'Manajemen Sidebar')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold">
            Manajemen Sidebar
        </h1>

        <p class="text-gray-500">
            Kelola menu sidebar aplikasi
        </p>

    </div>

    <a href="{{ route('sidebars.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">

        + Tambah Menu

    </a>

</div>

@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-5">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="min-w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="px-5 py-4 text-center">No</th>
                <th class="px-5 py-4 text-left">Nama Menu</th>
                <th class="px-5 py-4 text-left">Route</th>
                <th class="px-5 py-4 text-center">Urutan</th>
                <th class="px-5 py-4 text-center">Status</th>
                <th class="px-5 py-4 text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($sidebars as $sidebar)

            <tr class="border-t hover:bg-gray-50">

                <td class="px-5 py-4 text-center">
                    {{ $sidebars->firstItem() + $loop->index }}
                </td>

                <td class="px-5 py-4 font-semibold">
                    {{ $sidebar->nama_menu }}
                </td>

                <td class="px-5 py-4">
                    {{ $sidebar->route }}
                </td>

                <td class="px-5 py-4 text-center">
                    {{ $sidebar->urutan }}
                </td>

                <td class="px-5 py-4 text-center">

                    @if($sidebar->status)

                    <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm">>
                        Aktif
                    </span>

                    @else

                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm">
                        Nonaktif
                    </span>

                    @endif

                </td>

                <td class="px-5 py-4">

                    <div class="flex justify-center flex-wrap gap-2">

                        <a href="{{ route('sidebar-fields.index', ['sidebar' => $sidebar->id]) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg">

                            Kelola Field

                        </a>

                        <a href="{{ route('sidebars.show', $sidebar->id) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg">

                            Detail

                        </a>

                        <a href="{{ route('sidebars.edit', $sidebar->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">

                            Edit

                        </a>

                        <form action="{{ route('sidebars.destroy', $sidebar->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus menu ini?')"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg">

                                Hapus

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="text-center py-10 text-gray-500">

                    Belum ada menu sidebar.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

<div class="mt-6">

    {{ $sidebars->links() }}

</div>

@endsection