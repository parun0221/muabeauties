<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Muatype;
use App\Models\AdminRating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Admins::with('user', 'ratingmua')->paginate(10);

        foreach ($admin as $admins) {
            $admins->average_rating = $admins->ratingmua->avg('rating'); // Menambahkan rata-rata rating
        }
        $muatypes = Muatype::paginate();
        return view('dashboard.admin.index', ['admin'=>$admin, 'muatypes'=>$muatypes]);
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
        $admin = Admins::findOrFail($id);
$admin->average_rating = round($admin->ratingmua->avg('rating'), 1);

        $ratings = $admin->ratingmua()->with('customer')->get(); // Relasi ke model Rating dan User
        return view('dashboard.admin.ulasan', compact('admin', 'ratings'));

        
                          
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

    public function getMuatypesByAdmin($adminbookingId)
{
    $admin = Admins::with('muatypes')->find($adminbookingId);

    if ($admin) {
        return response()->json($admin->muatypes);
    }

    return response()->json([], 404);
}

// AdminController.php
// AdminController.php
public function getReviews($adminId)
{
    // Ambil ulasan yang terkait dengan adminId dan load data customer dan user-nya
    $reviews = AdminRating::where('admin_id', $adminId)
                          ->with('customer.user') // Mengambil data user yang memberikan ulasan
                          ->get();

    // Kirim data ulasan ke view
    return response()->json($reviews);
}



}
