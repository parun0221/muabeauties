<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Muatype;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Admins::with('user')->paginate(10);
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

    public function getMuatypesByAdmin($adminbookingId)
{
    $admin = Admins::with('muatypes')->find($adminbookingId);

    if ($admin) {
        return response()->json($admin->muatypes);
    }

    return response()->json([], 404);
}

}
