<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\User;
use App\Models\Muatype;
use App\Models\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Admins::with('user')->paginate(10);
        $muatypes = Muatype::paginate();
        $customer = Customers::with('user')->paginate(10);
        return view('dashboard.user.index', ['admin'=>$admin, 'muatypes'=>$muatypes, 'customer'=>$customer]);
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
        //
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
        return view('dashboard.user.edit', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone_number' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user = Auth::user();

    // Simpan profile photo jika diunggah
    if ($request->hasFile('profile_photo')) {
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $validated['profile_photo'] = $path;
    }

    // Update data user menggunakan array hasil validasi
    User::where('id', $user->id)->update($validated);
    
        return redirect('/profile')->with('success', 'Profile updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function newpassword(Request $request)
{
    $validated = $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $ouser = Auth::user();

    // Cek apakah current_password cocok dengan password yang tersimpan
    if (!Hash::check($validated['current_password'], Auth::user()->password)) {
        return response()->json(['errors' => ['current_password' => ['Password saat ini tidak benar.']]], 422);
    }
    

    // Mengupdate password baru
    // $user->update(['password' => Hash::make($validated['new_password'])]);
    User::where('id', $ouser->id)->update(['password' => Hash::make($validated['new_password'])]);


    // Redirect ke halaman sebelumnya dengan pesan sukses
    return redirect()->back()->with('success', 'Password berhasil diperbarui.');
}
}
