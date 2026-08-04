<?php

namespace App\Http\Controllers;

use App\Models\Sidebar;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public function index()
    {
        $sidebars = Sidebar::orderBy('urutan')->paginate(10);

        return view('sidebars.index', compact('sidebars'));
    }

    public function create()
    {
        return view('sidebars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|max:100',
            'route'     => 'required|unique:sidebars,route',
            'urutan'    => 'required|integer|min:1',
            'status'    => 'required|boolean',
        ]);

        Sidebar::create([
            'nama_menu' => $request->nama_menu,
            'route'     => $request->route,
            'urutan'    => $request->urutan,
            'status'    => $request->status,
        ]);

        return redirect()
            ->route('sidebars.index')
            ->with('success', 'Menu Sidebar berhasil ditambahkan.');
    }

    public function show(Sidebar $sidebar)
    {
        return view('sidebars.show', compact('sidebar'));
    }

    public function edit(Sidebar $sidebar)
    {
        return view('sidebars.edit', compact('sidebar'));
    }

    public function update(Request $request, Sidebar $sidebar)
    {
        $request->validate([
            'nama_menu' => 'required|max:100',
            'route'     => 'required|unique:sidebars,route,' . $sidebar->id,
            'urutan'    => 'required|integer|min:1',
            'status'    => 'required|boolean',
        ]);

        $sidebar->update([
            'nama_menu' => $request->nama_menu,
            'route'     => $request->route,
            'urutan'    => $request->urutan,
            'status'    => $request->status,
        ]);

        return redirect()
            ->route('sidebars.index')
            ->with('success', 'Menu Sidebar berhasil diperbarui.');
    }

    public function destroy(Sidebar $sidebar)
    {
        $sidebar->delete();

        return redirect()
            ->route('sidebars.index')
            ->with('success', 'Menu Sidebar berhasil dihapus.');
    }
}
