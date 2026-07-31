@extends('admin_utama.dashboard')

@section('content')

<div class="container mx-auto px-6 py-8">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">
            Detail Admin User
        </h1>

        <a href="{{ route('manajemen-admin-user.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-8">

        {{-- Avatar --}}
        <div class="flex justify-center mb-8">

            @if($adminUser->avatar)

            <img src="{{ asset('storage/' . $adminUser->avatar) }}"
                class="w-36 h-36 rounded-full object-cover border-4 border-gray-200 shadow">

            @else

            <div class="w-36 h-36 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-lg font-bold">
                No Image
            </div>

            @endif

        </div>

        {{-- Informasi Admin --}}
        <table class="table-auto w-full">

            <tbody>

                <tr class="border-b">
                    <td class="py-3 font-semibold w-1/3">
                        Kode Admin
                    </td>
                    <td>
                        {{ $adminUser->admin_code }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="py-3 font-semibold">
                        Nama
                    </td>
                    <td>
                        {{ $adminUser->name }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="py-3 font-semibold">
                        Email
                    </td>
                    <td>
                        {{ $adminUser->email }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="py-3 font-semibold">
                        Nomor HP
                    </td>
                    <td>
                        {{ $adminUser->phone ?? '-' }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="py-3 font-semibold">
                        Institusi
                    </td>
                    <td>
                        {{ $adminUser->institution ?? '-' }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="py-3 font-semibold">
                        Status
                    </td>
                    <td>

                        @if($adminUser->status == 'active')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Active
                        </span>

                        @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                            Inactive
                        </span>

                        @endif

                    </td>
                </tr>

                <tr class="border-b">
                    <td class="py-3 font-semibold">
                        Email Verified
                    </td>

                    <td>

                        @if($adminUser->email_verified_at)

                        <span class="text-green-600 font-semibold">
                            Sudah Verifikasi
                        </span>

                        @else

                        <span class="text-red-600 font-semibold">
                            Belum Verifikasi
                        </span>

                        @endif

                    </td>

                </tr>

                <tr class="border-b">
                    <td class="py-3 font-semibold">
                        Dibuat Oleh
                    </td>

                    <td>
                        {{ $adminUser->created_by ?? '-' }}
                    </td>

                </tr>

                <tr>
                    <td class="py-3 font-semibold">
                        Tanggal Dibuat
                    </td>

                    <td>
                        {{ $adminUser->created_at->format('d M Y H:i') }}
                    </td>

                </tr>

            </tbody>

        </table>

        {{-- Tombol --}}
        <div class="mt-8 flex gap-3">

            <a href="{{ route('manajemen-admin-user.edit', $adminUser->id) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">

                Edit

            </a>

            <a href="{{ route('manajemen-admin-user.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection