@extends('layouts.admin_utama')

@section('title','Tambah Field')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold">

            Tambah Field

        </h1>

        <p class="text-gray-500">

            Menu : {{ $sidebar->nama_menu }}

        </p>

    </div>

    <a href="{{ route('sidebar-fields.index',['sidebar'=>$sidebar->id]) }}"
        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

        ← Kembali

    </a>

</div>

@if($errors->any())

<div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg mb-5">

    <ul class="list-disc ml-5">

        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="bg-white rounded-xl shadow-lg p-6">

    <form action="{{ route('sidebar-fields.store', $sidebar->id) }}" method="POST">
        @include('sidebar_fields._form')

    </form>

</div>

@endsection