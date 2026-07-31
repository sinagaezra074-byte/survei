<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{

    public function index()
    {
        $adminUsers = User::where('role', 'admin_user')
            ->latest()
            ->paginate(10);

        return view('admin_user.index', compact('adminUsers'));
    }


    public function create()
    {
        return view('admin_user.create');
    }


    public function store(Request $request)
    {
        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20'
            ],

            'institution' => [
                'nullable',
                'string',
                'max:255'
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed'
            ],

            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ]

        ]);


        $avatar = null;


        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar')
                ->store('avatar', 'public');
        }


        User::create([

            'name'          => $request->name,

            'email'         => $request->email,

            'phone'         => $request->phone,

            'institution'   => $request->institution,

            'password'      => Hash::make($request->password),

            'role'          => 'admin_user',

            'status'        => 'active',

            'avatar'        => $avatar,

            'created_by'    => Auth::id(),

        ]);


        return redirect()
            ->route('manajemen-admin-user.index')
            ->with(
                'success',
                'Admin User berhasil ditambahkan.'
            );
    }



    public function show(string $id)
    {

        $adminUser = User::where('role', 'admin_user')
            ->findOrFail($id);


        return view(
            'admin_user.show',
            compact('adminUser')
        );
    }




    public function edit(string $id)
    {

        $adminUser = User::where('role', 'admin_user')
            ->findOrFail($id);


        return view(
            'admin_user.edit',
            compact('adminUser')
        );
    }





    public function update(Request $request, string $id)
    {

        $adminUser = User::where('role', 'admin_user')
            ->findOrFail($id);



        $request->validate([


            'name' => [
                'required',
                'string',
                'max:255'
            ],


            'email' => [
                'required',
                'email',
                'unique:users,email,' . $adminUser->id
            ],


            'phone' => [
                'nullable',
                'string',
                'max:20'
            ],


            'institution' => [
                'nullable',
                'string',
                'max:255'
            ],


            'status' => [
                'required',
                'in:active,inactive'
            ],


            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ]

        ]);




        if ($request->hasFile('avatar')) {


            if (

                $adminUser->avatar &&

                Storage::disk('public')
                ->exists($adminUser->avatar)

            ) {


                Storage::disk('public')
                    ->delete($adminUser->avatar);
            }



            $adminUser->avatar = $request->file('avatar')
                ->store('avatar', 'public');
        }




        $adminUser->update([

            'name'          => $request->name,

            'email'         => $request->email,

            'phone'         => $request->phone,

            'institution'   => $request->institution,

            'status'        => $request->status,

            'avatar'        => $adminUser->avatar,

        ]);



        return redirect()
            ->route('manajemen-admin-user.index')
            ->with(
                'success',
                'Data Admin User berhasil diperbarui.'
            );
    }





    public function destroy(string $id)
    {

        $adminUser = User::where('role', 'admin_user')
            ->findOrFail($id);



        if (

            $adminUser->avatar &&

            Storage::disk('public')
            ->exists($adminUser->avatar)

        ) {


            Storage::disk('public')
                ->delete($adminUser->avatar);
        }



        $adminUser->delete();



        return redirect()
            ->route('manajemen-admin-user.index')
            ->with(
                'success',
                'Admin User berhasil dihapus.'
            );
    }
}
