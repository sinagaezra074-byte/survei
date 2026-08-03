<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Menampilkan daftar Role.
     */
    public function index()
    {
        $roles = Role::with('permissions')
            ->latest()
            ->get();

        return view('admin_utama.role.index', compact('roles'));
    }

    /**
     * Menampilkan form tambah Role.
     */
    public function create()
    {
        $permissions = Permission::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin_utama.role.create',
            compact('permissions')
        );
    }

    /**
     * Menyimpan Role baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:roles,name',
            'description' => 'nullable|max:255',
            'is_active' => 'required|boolean',
            'permissions' => 'nullable|array',
        ]);

        DB::transaction(function () use ($request) {

            $role = Role::create([
                'name' => $request->name,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ]);

            $role->permissions()->sync(
                $request->permissions ?? []
            );
        });

        return redirect()
            ->route('role.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail Role.
     */
    public function show(Role $role)
    {
        $role->load('permissions');

        return view(
            'admin_utama.role.show',
            compact('role')
        );
    }

    /**
     * Menampilkan form edit Role.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::where('is_active', true)
            ->orderBy('name')
            ->get();

        $role->load('permissions');

        return view(
            'admin_utama.role.edit',
            compact(
                'role',
                'permissions'
            )
        );
    }

    /**
     * Mengupdate Role.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $role->id,
            'description' => 'nullable|max:255',
            'is_active' => 'required|boolean',
            'permissions' => 'nullable|array',
        ]);

        DB::transaction(function () use ($request, $role) {

            $role->update([
                'name' => $request->name,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ]);

            $role->permissions()->sync(
                $request->permissions ?? []
            );
        });

        return redirect()
            ->route('role.index')
            ->with('success', 'Role berhasil diperbarui.');
    }

    /**
     * Menghapus Role.
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();

        $role->delete();

        return redirect()
            ->route('role.index')
            ->with('success', 'Role berhasil dihapus.');
    }
}
