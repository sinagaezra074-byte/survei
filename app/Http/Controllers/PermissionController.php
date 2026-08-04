<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionSidebar;
use App\Models\PermissionAction;
use Illuminate\Http\Request;
use App\Models\Sidebar;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    private function menus()
    {
        $defaultMenus = collect([
            (object)[
                'id' => -1,
                'nama_menu' => 'Dashboard'
            ],
            (object)[
                'id' => -2,
                'nama_menu' => 'Manajemen Admin User'
            ],
            (object)[
                'id' => -3,
                'nama_menu' => 'Template Survei'
            ],
            (object)[
                'id' => -4,
                'nama_menu' => 'Backup Data'
            ],
            (object)[
                'id' => -5,
                'nama_menu' => 'Restore Data'
            ],
            (object)[
                'id' => -6,
                'nama_menu' => 'Data Survei'
            ],
            (object)[
                'id' => -7,
                'nama_menu' => 'Pertanyaan Survei'
            ],
            (object)[
                'id' => -8,
                'nama_menu' => 'Respon Survei'
            ],
            (object)[
                'id' => -9,
                'nama_menu' => 'Hak Akses'
            ],
            (object)[
                'id' => -10,
                'nama_menu' => 'Laporan'
            ],
            (object)[
                'id' => -11,
                'nama_menu' => 'Pengaturan'
            ],
        ]);

        $dynamicMenus = Sidebar::where('status', 1)
            ->orderBy('urutan')
            ->get(['id', 'nama_menu']);

        return $defaultMenus->merge($dynamicMenus);
    }
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
        $menus = $this->menus();

        return view(
            'admin_utama.hak_akses.create',
            compact('menus')
        );
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

            foreach ($this->menus() as $menu) {

                PermissionSidebar::create([
                    'permission_id' => $permission->id,
                    'sidebar_name' => $menu->nama_menu,
                    'is_allowed' => in_array($menu->id, $request->sidebars ?? []),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan Hak CRUD
            |--------------------------------------------------------------------------
            */

            foreach ($this->menus() as $menu) {

                $action = $request->actions[$menu->id] ?? [];

                PermissionAction::create([
                    'permission_id' => $permission->id,
                    'menu_name' => $menu->nama_menu,
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
            'actions'
        ]);

        $menus = $this->menus();

        return view(
            'admin_utama.hak_akses.edit',
            [
                'permission' => $hak_akses,
                'menus' => $menus
            ]
        );
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

            /*
        |--------------------------------------------------------------------------
        | Update Sidebar
        |--------------------------------------------------------------------------
        */

            PermissionSidebar::where(
                'permission_id',
                $hak_akses->id
            )->delete();

            foreach ($this->menus() as $menu) {

                PermissionSidebar::create([
                    'permission_id' => $hak_akses->id,
                    'sidebar_name' => $menu->nama_menu,
                    'is_allowed' => in_array($menu->id, $request->sidebars ?? []),
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | Update CRUD
        |--------------------------------------------------------------------------
        */

            PermissionAction::where(
                'permission_id',
                $hak_akses->id
            )->delete();

            foreach ($this->menus() as $menu) {

                $action = $request->actions[$menu->id] ?? [];

                PermissionAction::create([
                    'permission_id' => $hak_akses->id,
                    'menu_name' => $menu->nama_menu,
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
