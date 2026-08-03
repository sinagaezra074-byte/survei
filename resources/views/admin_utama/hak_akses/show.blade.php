@extends('layouts.admin_utama')

@section('title', 'Detail Hak Akses')

@section('content')

<div class="container mx-auto">

    <div class="bg-white rounded-lg shadow">

        <div class="border-b px-6 py-4">

            <h1 class="text-2xl font-bold">
                Detail Hak Akses
            </h1>

            <p class="text-gray-500">
                Informasi lengkap Hak Akses
            </p>

        </div>

        <div class="p-6">

            <div class="mb-6">
                <label class="font-semibold">Nama Hak Akses</label>
                <p class="mt-1">{{ $permission->name }}</p>
            </div>

            <div class="mb-6">
                <label class="font-semibold">Deskripsi</label>
                <p class="mt-1">
                    {{ $permission->description ?? '-' }}
                </p>
            </div>

            <div class="mb-6">
                <label class="font-semibold">Status</label>

                @if($permission->is_active)

                <span class="bg-green-500 text-white px-3 py-1 rounded">
                    Aktif
                </span>

                @else

                <span class="bg-red-500 text-white px-3 py-1 rounded">
                    Non Aktif
                </span>

                @endif

            </div>

            <hr class="my-6">

            <h2 class="text-xl font-bold mb-4">
                Hak Sidebar
            </h2>

            <div class="grid grid-cols-2 gap-3">

                @foreach($permission->sidebars as $sidebar)

                @if($sidebar->is_allowed)

                <div class="border rounded-lg p-2">

                    {{ $sidebar->sidebar_name }}

                </div>

                @endif

                @endforeach

            </div>

            <hr class="my-6">

            <h2 class="text-xl font-bold mb-4">
                Hak CRUD
            </h2>

            <div class="overflow-x-auto">

                <table class="min-w-full border">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="border px-3 py-2 text-left">
                                Menu
                            </th>

                            <th class="border px-3 py-2">
                                View
                            </th>

                            <th class="border px-3 py-2">
                                Create
                            </th>

                            <th class="border px-3 py-2">
                                Edit
                            </th>

                            <th class="border px-3 py-2">
                                Delete
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($permission->actions as $action)

                        <tr>

                            <td class="border px-3 py-2">
                                {{ $action->menu_name }}
                            </td>

                            <td class="border text-center">
                                {{ $action->can_view ? '✔' : '-' }}
                            </td>

                            <td class="border text-center">
                                {{ $action->can_create ? '✔' : '-' }}
                            </td>

                            <td class="border text-center">
                                {{ $action->can_edit ? '✔' : '-' }}
                            </td>

                            <td class="border text-center">
                                {{ $action->can_delete ? '✔' : '-' }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        <div class="border-t px-6 py-4">

            <a href="{{ route('hak-akses.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection