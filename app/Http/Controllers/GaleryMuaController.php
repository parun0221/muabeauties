<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Muatype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GaleryMua;

class GaleryMuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.user.galeryinput', [
            'admin' => Admins::with('user')->paginate(10),
            'muatypes' => Muatype::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'admin-mua-type-id' => 'required|exists:admin_mua_types,id',
        'galery' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file
        'deskripsi' => 'required|string|max:255', // Validasi deskripsi
    ]);

    // Menyimpan file gambar
    if ($request->hasFile('galery')) {
        $file = $request->file('galery');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('path/to/galeri'), $filename); // Sesuaikan path

        // Membuat entri baru di tabel galeri
        GaleryMua::create([
            'admin_mua_type_id' => $request->input('admin-mua-type-id'),
            'gambar' => $filename,
            'deskripsi' => $request->input('deskripsi'),
        ]);
    }

    return redirect()->back()->with('success', 'Galeri berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
