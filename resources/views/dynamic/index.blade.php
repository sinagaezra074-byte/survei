@extends('layouts.admin_utama')

@section('title', $sidebar->nama_menu)

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold">

            {{ $sidebar->nama_menu }}

        </h1>

        <p class="text-gray-500">

            Silahkan isi data.

        </p>

    </div>

</div>

@if(session('success'))

<div class="mb-5 rounded-lg bg-green-100 border border-green-400 p-4 text-green-700">

    {{ session('success') }}

</div>

@endif

<form
    action="{{ route('dynamic-form.store',$sidebar->id) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <div class="bg-white rounded-xl shadow-lg p-8">

        @foreach($fields as $field)

        <div class="mb-6">

            <label class="block font-semibold mb-2">

                {{ $field->nama_field }}

                @if($field->required)

                <span class="text-red-500">*</span>

                @endif

            </label>

            @switch($field->tipe_field)

            {{-- TEXT --}}
            @case('text')

            <input
                type="text"
                name="{{ $field->id }}"
                class="w-full border rounded-lg px-4 py-2">

            @break

            {{-- TEXTAREA --}}
            @case('textarea')

            <textarea
                name="{{ $field->id }}"
                rows="5"
                class="w-full border rounded-lg px-4 py-2"></textarea>

            @break

            {{-- NUMBER --}}
            @case('number')

            <input
                type="number"
                name="{{ $field->id }}"
                class="w-full border rounded-lg px-4 py-2">

            @break

            {{-- DATE --}}
            @case('date')

            <input
                type="date"
                name="{{ $field->id }}"
                class="w-full border rounded-lg px-4 py-2">

            @break

            {{-- EMAIL --}}
            @case('email')

            <input
                type="email"
                name="{{ $field->id }}"
                class="w-full border rounded-lg px-4 py-2">

            @break

            {{-- PASSWORD --}}
            @case('password')

            <input
                type="password"
                name="{{ $field->id }}"
                class="w-full border rounded-lg px-4 py-2">

            @break

            {{-- IMAGE --}}
            @case('image')

            <input
                type="file"
                name="{{ $field->id }}"
                accept="image/*"
                class="w-full">

            @break

            {{-- PDF --}}
            @case('pdf')

            <input
                type="file"
                name="{{ $field->id }}"
                accept=".pdf"
                class="w-full">

            @break

            {{-- FILE --}}
            @case('file')

            <input
                type="file"
                name="{{ $field->id }}"
                class="w-full">

            @break

            {{-- DEFAULT --}}
            @default

            <input
                type="text"
                name="{{ $field->id }}"
                class="w-full border rounded-lg px-4 py-2">

            @endswitch

        </div>

        @endforeach

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

            Simpan Data

        </button>

    </div>

</form>

@endsection