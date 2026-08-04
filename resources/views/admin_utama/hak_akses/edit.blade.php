@extends('layouts.admin_utama')

@section('title', 'Edit Hak Akses')

@section('content')

<div class="container mx-auto">

    <div class="bg-white rounded-lg shadow">

        <div class="border-b px-6 py-4">

            <h1 class="text-2xl font-bold">
                Edit Hak Akses
            </h1>

            <p class="text-gray-500">
                Perbarui data Hak Akses beserta Sidebar dan Hak CRUD.
            </p>

        </div>

        <form action="{{ route('hak-akses.update', $permission->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="p-6">

                {{-- Nama Hak Akses --}}
                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Nama Hak Akses
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $permission->name) }}"
                        class="w-full border rounded-lg px-4 py-2">

                    @error('name')
                    <small class="text-red-500">
                        {{ $message }}
                    </small>
                    @enderror

                </div>

                {{-- Deskripsi --}}
                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        rows="3"
                        class="w-full border rounded-lg px-4 py-2">{{ old('description', $permission->description) }}</textarea>

                </div>

                {{-- Status --}}
                <div class="mb-8">

                    <label class="block font-semibold mb-2">
                        Status
                    </label>

                    <select
                        name="is_active"
                        class="w-full border rounded-lg px-4 py-2">

                        <option value="1" {{ $permission->is_active ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0" {{ !$permission->is_active ? 'selected' : '' }}>
                            Non Aktif
                        </option>

                    </select>

                </div>

                {{-- Sidebar --}}
                <div class="mb-8">

                    <h3 class="text-lg font-bold mb-4">
                        Hak Sidebar
                    </h3>

                    <div class="grid grid-cols-2 gap-3">

                        @foreach($menus as $menu)

                        <label class="flex items-center gap-2">

                            <input
                                type="checkbox"
                                name="sidebars[]"
                                value="{{ $menu->id }}"
                                {{
            $permission->sidebars
                ->where('sidebar_name', $menu->nama_menu)
                ->where('is_allowed', true)
                ->count()
                ? 'checked'
                : ''
        }}>

                            {{ $menu->nama_menu }}

                        </label>

                        @endforeach

                    </div>

                </div>

                {{-- Hak CRUD --}}
                <div class="mb-8">

                    <h3 class="text-lg font-bold mb-4">
                        Hak CRUD
                    </h3>

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

                                @php
                                $action = $permission->actions->firstWhere(
                                'menu_name',
                                $menu->nama_menu
                                );
                                @endphp

                                <tr>

                                    <td class="border px-3 py-2">
                                        {{ $menu->nama_menu }}
                                    </td>

                                    <td class="border text-center">
                                        <input
                                            type="checkbox"
                                            name="actions[{{ $menu->id }}][view]"
                                            {{ optional($action)->can_view ? 'checked' : '' }}>
                                    </td>

                                    <td class="border text-center">
                                        <input
                                            type="checkbox"
                                            name="actions[{{ $menu->id }}][create]"
                                            {{ optional($action)->can_create ? 'checked' : '' }}>
                                    </td>

                                    <td class="border text-center">
                                        <input
                                            type="checkbox"
                                            name="actions[{{ $menu->id }}][edit]"
                                            {{ optional($action)->can_edit ? 'checked' : '' }}>
                                    </td>

                                    <td class="border text-center">
                                        <input
                                            type="checkbox"
                                            name="actions[{{ $menu->id }}][delete]"
                                            {{ optional($action)->can_delete ? 'checked' : '' }}>
                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="border-t px-6 py-4 flex justify-end gap-3">

                <a
                    href="{{ route('hak-akses.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">

                    Kembali

                </a>

                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg">

                    Update Hak Akses

                </button>

            </div>

        </form>

    </div>

</div>

@endsection