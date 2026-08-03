<div class="sidebar">


    <ul class="sidebar-menu">


        @php

        $user = auth()->user();

        $permission = null;

        if($user && $user->permission)
        {
        $permission = $user->permission;
        }

        @endphp



        {{-- Dashboard --}}
        <li>

            <a href="{{ route('dashboard') }}">

                Dashboard

            </a>

        </li>




        {{-- Menu Dinamis --}}
        @if($permission)


        @foreach($permission->sidebars as $sidebar)



        @if($sidebar->is_allowed)



        @if($sidebar->sidebar_name == 'Manajemen Admin User')


        <li>

            <a href="{{ route('manajemen-admin-user.index') }}">

                Manajemen Admin User

            </a>

        </li>



        @endif





        @if($sidebar->sidebar_name == 'Template Survei')


        <li>

            <a href="#">

                Template Survei

            </a>

        </li>



        @endif





        @if($sidebar->sidebar_name == 'Backup Data')


        <li>

            <a href="#">

                Backup Data

            </a>

        </li>



        @endif





        @if($sidebar->sidebar_name == 'Restore Data')


        <li>

            <a href="#">

                Restore Data

            </a>

        </li>



        @endif





        @if($sidebar->sidebar_name == 'Data Survei')


        <li>

            <a href="#">

                Data Survei

            </a>

        </li>



        @endif





        @if($sidebar->sidebar_name == 'Pertanyaan Survei')


        <li>

            <a href="#">

                Pertanyaan Survei

            </a>

        </li>



        @endif





        @if($sidebar->sidebar_name == 'Respon Survei')


        <li>

            <a href="#">

                Respon Survei

            </a>

        </li>



        @endif





        @if($sidebar->sidebar_name == 'Hak Akses')


        <li>

            <a href="{{ route('hak-akses.index') }}">

                Hak Akses

            </a>

        </li>



        @endif





        @if($sidebar->sidebar_name == 'Laporan')


        <li>

            <a href="#">

                Laporan

            </a>

        </li>



        @endif





        @if($sidebar->sidebar_name == 'Pengaturan')


        <li>

            <a href="#">

                Pengaturan

            </a>

        </li>



        @endif



        @endif



        @endforeach



        @endif



    </ul>


</div>