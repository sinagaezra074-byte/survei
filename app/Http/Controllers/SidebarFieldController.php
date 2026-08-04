<?php

namespace App\Http\Controllers;

use App\Models\Sidebar;
use App\Models\SidebarField;
use Illuminate\Http\Request;

class SidebarFieldController extends Controller
{
    /**
     * Menampilkan semua field berdasarkan sidebar
     */
    public function index(Sidebar $sidebar)
    {
        $fields = SidebarField::where('sidebar_id', $sidebar->id)
            ->orderBy('urutan')
            ->get();

        return view('sidebar_fields.index', compact('sidebar', 'fields'));
    }

    /**
     * Form tambah field
     */
    public function create(Sidebar $sidebar)
    {
        return view('sidebar_fields.create', compact('sidebar'));
    }

    /**
     * Simpan field baru
     */
    public function store(Request $request, Sidebar $sidebar)
    {
        $request->validate([
            'nama_field'    => 'required|max:100',
            'tipe_field'    => 'required',
            'urutan'        => 'required|integer',
            'status'        => 'required|boolean',
        ]);

        SidebarField::create([
            'sidebar_id'    => $sidebar->id,
            'nama_field'    => $request->nama_field,
            'tipe_field'    => $request->tipe_field,
            'required'      => $request->has('required'),
            'placeholder'   => $request->placeholder,
            'default_value' => $request->default_value,
            'urutan'        => $request->urutan,
            'status'        => $request->status,
        ]);

        return redirect()
            ->route('sidebar-fields.index', $sidebar->id)
            ->with('success', 'Field berhasil ditambahkan.');
    }

    /**
     * Detail field
     */
    public function show(SidebarField $field)
    {
        return view('sidebar_fields.show', compact('field'));
    }

    /**
     * Form edit field
     */
    public function edit(SidebarField $field)
    {
        $sidebar = $field->sidebar;

        return view('sidebar_fields.edit', compact('field', 'sidebar'));
    }

    /**
     * Update field
     */
    public function update(Request $request, SidebarField $field)
    {
        $request->validate([
            'nama_field'    => 'required|max:100',
            'tipe_field'    => 'required',
            'urutan'        => 'required|integer',
            'status'        => 'required|boolean',
        ]);

        $field->update([
            'nama_field'    => $request->nama_field,
            'tipe_field'    => $request->tipe_field,
            'required'      => $request->has('required'),
            'placeholder'   => $request->placeholder,
            'default_value' => $request->default_value,
            'urutan'        => $request->urutan,
            'status'        => $request->status,
        ]);

        return redirect()
            ->route('sidebar-fields.index', $field->sidebar_id)
            ->with('success', 'Field berhasil diperbarui.');
    }

    /**
     * Hapus field
     */
    public function destroy(SidebarField $field)
    {
        $sidebarId = $field->sidebar_id;

        $field->delete();

        return redirect()
            ->route('sidebar-fields.index', $sidebarId)
            ->with('success', 'Field berhasil dihapus.');
    }
}
