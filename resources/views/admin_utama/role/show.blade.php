@extends('layouts.admin_utama')

@section('title', 'Detail Role')

@section('content')

<div class="container mx-auto">


    <div class="bg-white shadow rounded-lg">



        <div class="border-b px-6 py-4">


            <h1 class="text-2xl font-bold">

                Detail Role

            </h1>


            <p class="text-gray-500">

                Informasi detail role dan hak akses.

            </p>



        </div>




        <div class="p-6">



            {{-- Nama Role --}}
            <div class="mb-5">


                <label class="block font-semibold mb-2">

                    Nama Role

                </label>



                <div class="border rounded-lg px-4 py-2 bg-gray-50">


                    {{ $role->name }}


                </div>



            </div>





            {{-- Deskripsi --}}
            <div class="mb-5">


                <label class="block font-semibold mb-2">

                    Deskripsi

                </label>



                <div class="border rounded-lg px-4 py-2 bg-gray-50">


                    {{ $role->description ?? '-' }}


                </div>



            </div>





            {{-- Status --}}
            <div class="mb-6">


                <label class="block font-semibold mb-2">

                    Status

                </label>



                @if($role->is_active)


                <span class="bg-green-500 text-white px-3 py-1 rounded">


                    Aktif


                </span>



                @else


                <span class="bg-red-500 text-white px-3 py-1 rounded">


                    Non Aktif


                </span>



                @endif



            </div>






            {{-- Permission --}}
            <div class="mb-6">


                <h3 class="text-lg font-bold mb-3">


                    Hak Akses Yang Dimiliki


                </h3>




                <div class="overflow-x-auto">


                    <table class="w-full border">



                        <thead class="bg-gray-100">


                            <tr>


                                <th class="border px-4 py-3">

                                    No

                                </th>


                                <th class="border px-4 py-3">

                                    Nama Hak Akses

                                </th>


                                <th class="border px-4 py-3">

                                    Deskripsi

                                </th>


                                <th class="border px-4 py-3">

                                    Status

                                </th>


                            </tr>



                        </thead>




                        <tbody>



                            @forelse($role->permissions as $permission)



                            <tr>



                                <td class="border px-4 py-3 text-center">


                                    {{ $loop->iteration }}


                                </td>




                                <td class="border px-4 py-3">


                                    {{ $permission->name }}


                                </td>




                                <td class="border px-4 py-3">


                                    {{ $permission->description ?? '-' }}


                                </td>




                                <td class="border px-4 py-3 text-center">



                                    @if($permission->is_active)



                                    <span class="bg-green-500 text-white px-3 py-1 rounded">


                                        Aktif


                                    </span>



                                    @else



                                    <span class="bg-red-500 text-white px-3 py-1 rounded">


                                        Non Aktif


                                    </span>



                                    @endif



                                </td>



                            </tr>




                            @empty



                            <tr>


                                <td colspan="4"
                                    class="border px-4 py-5 text-center">


                                    Belum ada Hak Akses.


                                </td>


                            </tr>




                            @endforelse



                        </tbody>




                    </table>



                </div>



            </div>




        </div>





        <div class="border-t px-6 py-4 flex justify-end gap-3">



            <a
                href="{{ route('role.edit',$role->id) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg">


                Edit


            </a>





            <a
                href="{{ route('role.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">


                Kembali


            </a>



        </div>




    </div>



</div>


@endsection