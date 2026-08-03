@extends('layouts.admin_utama')

@section('title', 'Role')

@section('content')

<div class="container mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-2xl font-bold">
                Role
            </h1>

            <p class="text-gray-500">
                Kelola role dan permission pengguna.
            </p>
        </div>

        <a href="{{ route('role.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

            Tambah Role

        </a>

    </div>


    @if(session('success'))

    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-5">

        {{ session('success') }}

    </div>

    @endif


    <div class="bg-white shadow rounded-lg">

        <div class="p-6">

            <div class="overflow-x-auto">

                <table class="w-full border">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="border px-4 py-3">
                                No
                            </th>

                            <th class="border px-4 py-3">
                                Nama Role
                            </th>

                            <th class="border px-4 py-3">
                                Deskripsi
                            </th>

                            <th class="border px-4 py-3">
                                Permission
                            </th>

                            <th class="border px-4 py-3">
                                Status
                            </th>

                            <th class="border px-4 py-3">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($roles as $role)

                        <tr>

                            <td class="border px-4 py-3 text-center">

                                {{ $loop->iteration }}

                            </td>


                            <td class="border px-4 py-3">

                                {{ $role->name }}

                            </td>


                            <td class="border px-4 py-3">

                                {{ $role->description ?? '-' }}

                            </td>


                            <td class="border px-4 py-3">

                                @forelse($role->permissions as $permission)

                                <span class="inline-block bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm mr-1 mb-1">

                                    {{ $permission->name }}

                                </span>

                                @empty

                                <span class="text-gray-500">

                                    Tidak ada permission

                                </span>

                                @endforelse

                            </td>


                            <td class="border px-4 py-3 text-center">


                                @if($role->is_active)

                                <span class="bg-green-500 text-white px-3 py-1 rounded">

                                    Aktif

                                </span>

                                @else

                                <span class="bg-red-500 text-white px-3 py-1 rounded">

                                    Non Aktif

                                </span>

                                @endif


                            </td>


                            <td class="border px-4 py-3 text-center">


                                <a href="{{ route('role.show',$role->id) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded">

                                    Detail

                                </a>


                                <a href="{{ route('role.edit',$role->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">

                                    Edit

                                </a>


                                <form action="{{ route('role.destroy',$role->id) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf

                                    @method('DELETE')


                                    <button
                                        onclick="return confirm('Yakin ingin menghapus role ini?')"
                                        class="bg-red-500 text-white px-3 py-1 rounded">

                                        Hapus

                                    </button>


                                </form>


                            </td>


                        </tr>


                        @empty


                        <tr>

                            <td colspan="6"
                                class="border px-4 py-5 text-center">

                                Belum ada data role.

                            </td>

                        </tr>


                        @endforelse


                    </tbody>


                </table>


            </div>


        </div>


    </div>


</div>


@endsection