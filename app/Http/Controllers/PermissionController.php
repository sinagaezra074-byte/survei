<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionSidebar;
use App\Models\PermissionAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Daftar menu sistem
     */
    private array $menus = [
        'Dashboard',
        'Manajemen Admin User',
        'Template Survei',
        'Backup Data',
        'Restore Data',
        'Data Survei',
        'Pertanyaan Survei',
        'Respon Survei',
        'Hak Akses',
        'Laporan',
        'Pengaturan',
    ];

    /**
     * Menampilkan daftar Hak Akses
     */
    public function index()
    {
        $permissions = Permission::with(['users'])
            ->latest()
            ->get();

        return view('admin_utama.hak_akses.index', compact('permissions'));
    }

    /**
     * Form tambah Hak Akses
     */
    public function create()
    {
        return view('admin_utama.hak_akses.create', [
            'menus' => $this->menus,
        ]);
    }

    /**
     * Simpan Hak Akses
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        DB::beginTransaction();

        try {

            $permission = Permission::create([
                'name' => $request->name,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Simpan Sidebar
            |--------------------------------------------------------------------------
            */

            foreach ($this->menus as $menu) {

                PermissionSidebar::create([
                    'permission_id' => $permission->id,
                    'sidebar_name' => $menu,
                    'is_allowed' => in_array($menu, $request->sidebars ?? []),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan Hak CRUD
            |--------------------------------------------------------------------------
            */

            foreach ($this->menus as $menu) {

                $action = $request->actions[$menu] ?? [];

                PermissionAction::create([
                    'permission_id' => $permission->id,
                    'menu_name' => $menu,
                    'can_view' => isset($action['view']),
                    'can_create' => isset($action['create']),
                    'can_edit' => isset($action['edit']),
                    'can_delete' => isset($action['delete']),
                ]);
            }

            DB::commit();

            return redirect()
                ->route('hak-akses.index')
                ->with('success', 'Hak Akses berhasil ditambahkan.');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Detail Hak Akses
     */
    public function show(Permission $hak_akses)
    {
        $hak_akses->load([
            'sidebars',
            'actions',
            'users',
        ]);

        return view('admin_utama.hak_akses.show', [
            'permission' => $hak_akses,
        ]);
    }


    public function edit(Permission $hak_akses)
    {
        $hak_akses->load([
            'sidebars',
            'actions',
        ]);

        return view('admin_utama.hak_akses.edit', [
            'permission' => $hak_akses,
            'menus' => $this->menus,
        ]);
    }

    /**
     * Update Hak Akses
     */
    public function update(Request $request, Permission $hak_akses)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $hak_akses->id,
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        DB::beginTransaction();

        try {

            $hak_akses->update([
                'name' => $request->name,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ]);



            PermissionSidebar::where('permission_id', $hak_akses->id)->delete();

            foreach ($this->menus as $menu) {

                PermissionSidebar::create([
                    'permission_id' => $hak_akses->id,
                    'sidebar_name' => $menu,
                    'is_allowed' => in_array($menu, $request->sidebars ?? []),
                ]);
            }


            PermissionAction::where('permission_id', $hak_akses->id)->delete();

            foreach ($this->menus as $menu) {

                $action = $request->actions[$menu] ?? [];

                PermissionAction::create([
                    'permission_id' => $hak_akses->id,
                    'menu_name' => $menu,
                    'can_view' => isset($action['view']),
                    'can_create' => isset($action['create']),
                    'can_edit' => isset($action['edit']),
                    'can_delete' => isset($action['delete']),
                ]);
            }

            DB::commit();

            return redirect()
                ->route('hak-akses.index')
                ->with('success', 'Hak Akses berhasil diperbarui.');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Hapus Hak Akses
     */
    public function destroy(Permission $hak_akses)
    {
        DB::beginTransaction();

        try {

            $hak_akses->sidebars()->delete();
            $hak_akses->actions()->delete();
            $hak_akses->delete();

            DB::commit();

            return redirect()
                ->route('hak-akses.index')
                ->with('success', 'Hak Akses berhasil dihapus.');
        } catch (\Exception $e) {

            DB::rollBack();

            dd($e->getMessage());
        }
    }
}
