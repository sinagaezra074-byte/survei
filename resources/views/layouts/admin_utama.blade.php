<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Utama - MInfoIn')
    </title>


    @vite(['resources/css/app.css','resources/js/app.js'])

</head>


<body class="bg-gray-100">


    <div class="flex min-h-screen">


        {{-- SIDEBAR --}}
        <aside class="w-72 bg-slate-800 text-white flex-shrink-0">


            <div class="p-6 border-b border-slate-700">

                <h1 class="text-2xl font-bold">
                    MInfoIn
                </h1>

                <p class="text-sm text-gray-300">
                    Admin Utama
                </p>

            </div>



            <nav class="mt-5">


                <a href="{{ route('admin.utama') }}"
                    class="block px-6 py-3 hover:bg-slate-700">

                    🏠 Dashboard

                </a>



                <a href="{{ route('manajemen-admin-user.index') }}"
                    class="block px-6 py-3 hover:bg-slate-700">

                    👤 Manajemen Admin User

                </a>



                <a href="#"
                    class="block px-6 py-3 hover:bg-slate-700">

                    📄 Template Survei

                </a>



                <a href="#"
                    class="block px-6 py-3 hover:bg-slate-700">

                    💾 Backup Data

                </a>



                <a href="#"
                    class="block px-6 py-3 hover:bg-slate-700">

                    🔄 Restore Data

                </a>



                <a href="#"
                    class="block px-6 py-3 hover:bg-slate-700">

                    📋 Data Survei

                </a>



                <a href="#"
                    class="block px-6 py-3 hover:bg-slate-700">

                    ❓ Pertanyaan Survei

                </a>



                <a href="#"
                    class="block px-6 py-3 hover:bg-slate-700">

                    📊 Respon Survei

                </a>



                <a href="{{ route('hak-akses.index') }}"
                    class="block px-6 py-3 hover:bg-slate-700">

                    🔐 Hak Akses

                </a>



                <a href="#"
                    class="block px-6 py-3 hover:bg-slate-700">

                    📑 Laporan

                </a>



                <a href="{{ route('sidebars.index') }}"
                    class="block px-6 py-3 hover:bg-slate-700">

                    📂 Manajemen Sidebar

                </a>



                <hr class="my-3 border-slate-600">



                <p class="px-6 py-2 text-xs uppercase text-gray-400">
                    Menu Dinamis
                </p>



                @isset($dynamicSidebars)

                @foreach($dynamicSidebars as $menu)

                <a href="{{ route('dynamic-form.index',$menu->id) }}"
                    class="block px-6 py-3 hover:bg-slate-700">

                    📁 {{ $menu->nama_menu }}

                </a>

                @endforeach

                @endisset




                <a href="#"
                    class="block px-6 py-3 hover:bg-slate-700">

                    ⚙ Pengaturan

                </a>


            </nav>


        </aside>






        {{-- CONTENT --}}

        <main class="flex-1">


            <header class="bg-white shadow px-8 py-5 flex justify-between items-center">


                <h2 class="text-2xl font-bold">
                    @yield('header','Dashboard Admin Utama')
                </h2>



                <div class="flex items-center gap-4">


                    <span class="font-semibold">

                        {{ Auth::user()->name }}

                    </span>



                    <form method="POST" action="{{ route('logout') }}">

                        @csrf


                        <button
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">

                            Logout

                        </button>


                    </form>


                </div>


            </header>





            <section class="p-8">


                @yield('content')


            </section>



        </main>



    </div>



</body>

</html>