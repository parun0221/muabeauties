<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\AdminMuaType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMuaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        'admin_id' => 'required|exists:admins,id',
        'muatype_id' => 'required|exists:muatypes,id',
    ]);

    $adminId = $request->admin_id;
    $muatypeId = $request->muatype_id;

    // Cek apakah hubungan sudah ada
    $exists = DB::table('admin_mua_types')
                ->where('admin_id', $adminId)
                ->where('muatype_id', $muatypeId)
                ->exists();

    if (!$exists) {
        // Jika tidak ada, masukkan data
        DB::table('admin_mua_types')->insert([
            'admin_id' => $adminId,
            'muatype_id' => $muatypeId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Spesialisasi berhasil ditambahkan.');
    } else {
        return redirect()->back()->with('error', 'Spesialisasi sudah ada untuk admin ini.');
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $adminId)
    {
        $admin = Admins::with('muatypes')->findOrFail($adminId);
        return response()->json($admin->muatypes);
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
    public function destroy($adminId, $muatypeId)
    {
        // Temukan admin
        $admin = Admins::findOrFail($adminId);

        // Hapus spesialisasi (muatype) tertentu dari admin
        $admin->muatypes()->detach($muatypeId);

        return response()->json(['message' => 'Spesialisasi berhasil dihapus dari admin.']);
    }
}
