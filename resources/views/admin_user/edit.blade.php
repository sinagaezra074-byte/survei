@extends('admin_utama.dashboard')

@section('content')

<div class="container mx-auto px-6 py-8">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">
            Edit Admin User
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

    <form action="{{ route('manajemen-admin-user.update', $adminUser->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white shadow rounded-lg p-6">

        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">Nama</label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $adminUser->name) }}"
                class="w-full border rounded p-2"
                required>

            @error('name')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $adminUser->email) }}"
                class="w-full border rounded p-2"
                required>

            @error('email')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Nomor HP --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">Nomor HP</label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone', $adminUser->phone) }}"
                class="w-full border rounded p-2">

            @error('phone')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Institusi --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">Institusi</label>

            <input
                type="text"
                name="institution"
                value="{{ old('institution', $adminUser->institution) }}"
                class="w-full border rounded p-2">

            @error('institution')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">Status</label>

            <select
                name="status"
                class="w-full border rounded p-2">

                <option value="active"
                    {{ old('status', $adminUser->status) == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive"
                    {{ old('status', $adminUser->status) == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

            @error('status')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Avatar Lama --}}
        @if($adminUser->avatar)
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Avatar Saat Ini
            </label>

            <img src="{{ asset('storage/'.$adminUser->avatar) }}"
                class="w-24 h-24 rounded-full object-cover border">
        </div>
        @endif

        {{-- Avatar Baru --}}
        <div class="mb-6">
            <label class="block mb-2 font-semibold">
                Ganti Avatar
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
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">

                Update
            </button>

            <a href="{{ route('manajemen-admin-user.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">

                Batal
            </a>
        </div>

    </form>

</div>

@endsection