<?php

namespace App\Http\Controllers;

use App\Models\Muatype;
use Illuminate\Http\Request;

class MuatypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $muatypes = Muatype::paginate(10);
        return view('dashboard.muatype.index', ['muatypes'=>$muatypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.muatype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_mua' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_jam' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Proses upload gambar
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('muatype_images', 'public');
            $validated['gambar'] = $path; // Simpan path gambar ke dalam array $validated
        }

        // Simpan data muatype
        Muatype::create($validated);

        return redirect('/dashboard-muatype')->with('pesan','data berhasil di simpan');
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
        $muatype = Muatype::findOrFail($id);
    return response()->json($muatype);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_mua' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_jam' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Proses upload gambar
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('muatype_images', 'public');
            $validated['gambar'] = $path; // Simpan path gambar ke dalam array $validated
        }

        // Simpan data muatype
        Muatype::where('id', $id)->update($validated);

        return redirect('/dashboard-muatype')->with('pesan','data berhasil di simpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $muatype = Muatype::findOrFail($id);
        $muatype->delete();
    
        return response()->json(['success' => true]);
    }
}
