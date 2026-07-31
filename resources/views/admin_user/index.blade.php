@extends('layouts.admin_utama')

@section('content')

<div class="container mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">
            Data Admin User
        </h1>

        <a href="{{ route('manajemen-admin-user.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">

            + Tambah Admin User

        </a>

    </div>

    {{-- Success Message --}}
    @if(session('success'))

    <div class="mb-5 rounded-lg border border-green-300 bg-green-100 p-4 text-green-700">
        {{ session('success') }}
    </div>

    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Avatar</th>
                        <th class="px-4 py-3 text-left">Kode Admin</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($adminUsers as $admin)

                    <tr class="border-b hover:bg-gray-50">

                        {{-- Nomor --}}
                        <td class="px-4 py-3">

                            {{ $adminUsers->firstItem() + $loop->index }}

                        </td>

                        {{-- Avatar --}}
                        <td class="px-4 py-3">

                            @if($admin->avatar)

                            <img src="{{ asset('storage/'.$admin->avatar) }}"
                                class="w-12 h-12 rounded-full object-cover border">

                            @else

                            <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-xs text-gray-600">
                                No Image
                            </div>

                            @endif

                        </td>

                        {{-- Kode Admin --}}
                        <td class="px-4 py-3 font-semibold">

                            {{ $admin->admin_code }}

                        </td>

                        {{-- Nama --}}
                        <td class="px-4 py-3">

                            {{ $admin->name }}

                        </td>

                        {{-- Email --}}
                        <td class="px-4 py-3">

                            {{ $admin->email }}

                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-3">

                            @if($admin->status == 'active')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Active
                            </span>

                            @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                Inactive
                            </span>

                            @endif

                        </td>

                        {{-- Tombol --}}
                        <td class="px-4 py-3">

                            <div class="flex gap-2 justify-center">

                                <a href="{{ route('manajemen-admin-user.show', $admin->id) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">

                                    Detail

                                </a>

                                <a href="{{ route('manajemen-admin-user.edit', $admin->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                    Edit

                                </a>

                                <form action="{{ route('manajemen-admin-user.destroy', $admin->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menghapus Admin User ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-8 text-gray-500">

                            Belum ada data Admin User.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Pagination --}}
    <div class="mt-6">

        {{ $adminUsers->links() }}

    </div>

</div>

@endsection