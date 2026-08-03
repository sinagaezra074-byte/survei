@extends('layouts.admin_utama')

@section('title', 'Hak Akses')

@section('content')

<div class="p-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold">
                Hak Akses
            </h1>

            <p class="text-gray-500">
                Kelola Hak Akses Admin User
            </p>
        </div>

        <a href="{{ route('hak-akses.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">

            + Tambah Hak Akses

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

                    <th class="px-5 py-4 text-left font-semibold">
                        No
                    </th>

                    <th class="px-5 py-4 text-left font-semibold">
                        Nama Hak Akses
                    </th>

                    <th class="px-5 py-4 text-left font-semibold">
                        Deskripsi
                    </th>

                    <th class="px-5 py-4 text-center font-semibold">
                        Jumlah User
                    </th>

                    <th class="px-5 py-4 text-center font-semibold">
                        Status
                    </th>

                    <th class="px-5 py-4 text-right font-semibold">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($permissions as $permission)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-5 py-4">

                        {{ $loop->iteration }}

                    </td>

                    <td class="px-5 py-4 font-semibold">

                        {{ $permission->name }}

                    </td>

                    <td class="px-5 py-4">

                        {{ $permission->description ?? '-' }}

                    </td>

                    <td class="px-5 py-4 text-center">

                        {{ $permission->users->count() }}

                    </td>

                    <td class="px-5 py-4 text-center">

                        @if($permission->is_active)

                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">

                            Aktif

                        </span>

                        @else

                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm">

                            Nonaktif

                        </span>

                        @endif

                    </td>

                    <td class="px-5 py-4">

                        <div class="flex justify-end items-center gap-2">

                            <a href="{{ route('hak-akses.show', $permission->id) }}"
                                class="inline-block bg-blue-600 text-white hover:bg-blue-700 px-3 py-2 rounded-lg">
                                Detail
                            </a>

                            <a href="{{ route('hak-akses.edit', $permission->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-sm">

                                Edit

                            </a>

                            <form
                                action="{{ route('hak-akses.destroy', $permission->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center py-8 text-gray-500">

                        Belum ada data Hak Akses.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection