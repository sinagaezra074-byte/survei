@extends('layouts.admin_utama')

@section('title', 'Edit Menu Sidebar')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-3xl font-bold">
            Edit Menu Sidebar
        </h1>

        <p class="text-gray-500">
            Perbarui data menu sidebar
        </p>
    </div>

    <a href="{{ route('sidebars.index') }}"
        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

        Kembali

    </a>

</div>

<div class="bg-white rounded-xl shadow p-6">

    <form action="{{ route('sidebars.update', $sidebar->id) }}"
        method="POST">

        @csrf
        @method('PUT')

        @include('sidebars._form')

    </form>

</div>

@endsection