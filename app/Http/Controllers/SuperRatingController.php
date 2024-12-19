<?php

namespace App\Http\Controllers;

use App\Models\AdminRating;
use Illuminate\Http\Request;

class SuperRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = AdminRating::query();

    // Filter berdasarkan pencarian nama customer atau admin
    if ($request->has('search') && $request->search) {
        $query->whereHas('customer.user', function ($q) use ($request) {
            $q->where('review', 'like', '%' . $request->search . '%');
        })
        ->orWhereHas('admin.user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }

    // Filter berdasarkan rating
    if ($request->has('rating') && $request->rating) {
        $query->where('rating', $request->rating);
    }

    // Ambil data rating sesuai filter
    $ratings = $query->get();

    return view('dashboard.super.ulasan', compact('ratings'));
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
}
