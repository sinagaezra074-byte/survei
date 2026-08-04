@extends('layouts.admin_utama')

@section('title','Detail Field')

@section('content')

<div class="bg-white rounded-xl shadow-lg p-8">

    <h1 class="text-3xl font-bold mb-6">

        Detail Field

    </h1>

    <table class="w-full">

        <tr>
            <td class="font-semibold w-52">Nama Field</td>
            <td>{{ $field->nama_field }}</td>
        </tr>

        <tr>
            <td class="font-semibold">Tipe</td>
            <td>{{ ucfirst($field->tipe_field) }}</td>
        </tr>

        <tr>
            <td class="font-semibold">Placeholder</td>
            <td>{{ $field->placeholder ?: '-' }}</td>
        </tr>

        <tr>
            <td class="font-semibold">Default Value</td>
            <td>{{ $field->default_value ?: '-' }}</td>
        </tr>

        <tr>
            <td class="font-semibold">Required</td>
            <td>{{ $field->required ? 'Ya' : 'Tidak' }}</td>
        </tr>

        <tr>
            <td class="font-semibold">Status</td>
            <td>{{ $field->status ? 'Aktif' : 'Nonaktif' }}</td>
        </tr>

        <tr>
            <td class="font-semibold">Urutan</td>
            <td>{{ $field->urutan }}</td>
        </tr>

    </table>

    <div class="mt-8">

        <a href="{{ route('sidebar-fields.index',['sidebar'=>$field->sidebar_id]) }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">

            Kembali

        </a>

    </div>

</div>

@endsection