@extends('layouts.admin_utama')

@section('title', 'Tambah Menu Sidebar')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold">
            Tambah Menu Sidebar
        </h1>

        <p class="text-gray-500">
            Tambahkan menu baru yang akan muncul pada sistem.
        </p>

    </div>

    <a href="{{ route('sidebars.index') }}"
        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

        ← Kembali

    </a>

</div>

@if ($errors->any())

<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-5">

    <ul class="list-disc ml-5">

        @foreach ($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="bg-white rounded-xl shadow-lg p-6">

    <form action="{{ route('sidebars.store') }}" method="POST">

        @include('sidebars._form')

    </form>

</div>

@endsection