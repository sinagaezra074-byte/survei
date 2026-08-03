@extends('layouts.admin_utama')

@section('title', 'Edit Role')

@section('content')

<div class="container mx-auto">

    <div class="bg-white shadow rounded-lg">


        <div class="border-b px-6 py-4">

            <h1 class="text-2xl font-bold">

                Edit Role

            </h1>


            <p class="text-gray-500">

                Perbarui role dan hak akses yang dimiliki.

            </p>


        </div>



        <form
            action="{{ route('role.update',$role->id) }}"
            method="POST">


            @csrf

            @method('PUT')



            <div class="p-6">



                {{-- Nama Role --}}
                <div class="mb-5">


                    <label class="block font-semibold mb-2">

                        Nama Role

                    </label>



                    <input
                        type="text"
                        name="name"
                        value="{{ old('name',$role->name) }}"
                        class="w-full border rounded-lg px-4 py-2">



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
                        class="w-full border rounded-lg px-4 py-2">{{ old('description',$role->description) }}</textarea>



                </div>




                {{-- Status --}}
                <div class="mb-6">


                    <label class="block font-semibold mb-2">

                        Status

                    </label>



                    <select
                        name="is_active"
                        class="w-full border rounded-lg px-4 py-2">


                        <option value="1"
                            {{ $role->is_active == 1 ? 'selected':'' }}>

                            Aktif

                        </option>



                        <option value="0"
                            {{ $role->is_active == 0 ? 'selected':'' }}>

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



                        @php

                        $checked = $role->permissions
                        ->contains('id',$permission->id);

                        @endphp




                        <label
                            class="flex items-center gap-3 border rounded-lg p-3">



                            <input
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission->id }}"
                                {{ $checked ? 'checked':'' }}>



                            <div>


                                <p class="font-semibold">

                                    {{ $permission->name }}

                                </p>


                                <p class="text-sm text-gray-500">

                                    {{ $permission->description ?? '-' }}

                                </p>


                            </div>



                        </label>




                        @endforeach



                    </div>



                </div>



            </div>




            <div class="border-t px-6 py-4 flex justify-end gap-3">


                <a
                    href="{{ route('role.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">


                    Kembali


                </a>




                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg">


                    Update Role


                </button>



            </div>




        </form>



    </div>


</div>


@endsection