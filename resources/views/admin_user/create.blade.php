@extends('admin_utama.dashboard')

@section('content')

<div class="container mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">
            Tambah Admin User
        </h1>

        <a href="{{ route('manajemen-admin-user.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded mb-5">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('manajemen-admin-user.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white shadow rounded-lg p-6">

        @csrf

        {{-- Nama --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Nama
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border rounded p-2"
                required>

            @error('name')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full border rounded p-2"
                required>

            @error('email')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Password
            </label>

            <input
                type="password"
                name="password"
                class="w-full border rounded p-2"
                required>

            @error('password')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Konfirmasi Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="w-full border rounded p-2"
                required>
        </div>

        {{-- Nomor HP --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Nomor HP
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                class="w-full border rounded p-2">

            @error('phone')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Institusi --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Institusi
            </label>

            <input
                type="text"
                name="institution"
                value="{{ old('institution') }}"
                class="w-full border rounded p-2">

            @error('institution')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Avatar --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold">
                Avatar
            </label>

            <input
                type="file"
                name="avatar"
                class="w-full border rounded p-2">

            @error('avatar')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div class="flex gap-3">
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

                Simpan
            </button>

            <a href="{{ route('manajemen-admin-user.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">

                Batal
            </a>
        </div>

    </form>

</div>

@endsection