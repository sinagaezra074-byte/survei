@extends('layouts.admin_utama')

@section('title','Detail Menu Sidebar')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <h2 class="text-2xl font-bold mb-6">
        Detail Menu Sidebar
    </h2>

    <table class="table-auto">

        <tr>
            <td class="pr-6 font-semibold">Nama Menu</td>
            <td>{{ $sidebar->nama_menu }}</td>
        </tr>

        <tr>
            <td class="pr-6 font-semibold">Route</td>
            <td>{{ $sidebar->route }}</td>
        </tr>

        <tr>
            <td class="pr-6 font-semibold">Urutan</td>
            <td>{{ $sidebar->urutan }}</td>
        </tr>

        <tr>
            <td class="pr-6 font-semibold">Status</td>
            <td>
                {{ $sidebar->status ? 'Aktif' : 'Nonaktif' }}
            </td>
        </tr>

    </table>

    <div class="mt-6">

        <a href="{{ route('sidebars.index') }}"
            class="bg-gray-600 text-white px-5 py-2 rounded-lg">

            Kembali

        </a>

    </div>

</div>

@endsection