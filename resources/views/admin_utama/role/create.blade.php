@extends('layouts.admin_utama')

@section('title', 'Tambah Role')

@section('content')

<div class="container mx-auto">

    <div class="bg-white shadow rounded-lg">

        <div class="border-b px-6 py-4">

            <h1 class="text-2xl font-bold">

                Tambah Role

            </h1>

            <p class="text-gray-500">

                Tambahkan role dan tentukan hak aksesnya.

            </p>

        </div>


        <form action="{{ route('role.store') }}" method="POST">

            @csrf


            <div class="p-6">


                {{-- Nama Role --}}
                <div class="mb-5">

                    <label class="block font-semibold mb-2">

                        Nama Role

                    </label>


                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Contoh : Guru">


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
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Masukkan deskripsi role">{{ old('description') }}</textarea>


                </div>



                {{-- Status --}}
                <div class="mb-6">


                    <label class="block font-semibold mb-2">

                        Status

                    </label>


                    <select
                        name="is_active"
                        class="w-full border rounded-lg px-4 py-2">


                        <option value="1">

                            Aktif

                        </option>


                        <option value="0">

                            Non Aktif

                        </option>


                    </select>


                </div>



                {{-- Permission --}}
                <div class="mb-6">


                    <h3 class="text-lg font-bold mb-3">

                        Pilih Hak Akses

                    </h3>



                    <div class="grid grid-cols-2 gap-4">


                        @foreach($permissions as $permission)


                        <label
                            class="flex items-center gap-3 border rounded-lg p-3">


                            <input
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission->id }}">



                            <div>


                                <p class="font-semibold">

                                    {{ $permission->name }}

                                </p>


                                <p class="text-sm text-gray-500">

                                    {{ $permission->description ?? 'Tidak ada deskripsi' }}

                                </p>


                            </div>



                        </label>


                        @endforeach


                    </div>


                </div>


            </div>



            <div class="border-t px-6 py-4 flex justify-end gap-3">


                <a href="{{ route('role.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">


                    Kembali


                </a>



                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">


                    Simpan Role


                </button>


            </div>



        </form>


    </div>


</div>


@endsection