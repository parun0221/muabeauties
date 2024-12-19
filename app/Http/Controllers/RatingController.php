<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Admins;
use App\Models\Muatype;
use App\Models\AdminRating;
use Illuminate\Http\Request;
use App\Models\MuatypeRating;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $timePeriod = $request->get('time_period', 'all'); // Default ke "all"
    $queryOrders = Order::query();

    // Filter berdasarkan periode waktu
    if ($timePeriod === 'this_month') {
        $queryOrders->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    } elseif ($timePeriod === 'this_year') {
        $queryOrders->whereYear('created_at', now()->year);
    }

    $totalOrders = $queryOrders->count();
    $totalPrice = $queryOrders->sum('total_price');
    $totalCustomers = $queryOrders->distinct('customer_id')->count('customer_id');

    $favoriteAdmins = Admins::join('users', 'admins.user_id', '=', 'users.id')
        ->leftJoinSub($queryOrders, 'filtered_orders', function ($join) {
            $join->on('admins.id', '=', 'filtered_orders.admin_id');
        })
        ->leftJoin('admin_ratings', 'admins.id', '=', 'admin_ratings.admin_id')
        ->select(
            'admins.id',
            'users.name as admin_name',
            DB::raw('COUNT(filtered_orders.id) as total_orders'),
            DB::raw('AVG(admin_ratings.rating) as average_rating')
        )
        ->groupBy('admins.id', 'users.name')
        ->orderByDesc('total_orders')
        ->limit(10)
        ->get();

    $favoriteMuaTypes = Muatype::leftJoinSub($queryOrders, 'filtered_orders', function ($join) {
            $join->on('muatypes.id', '=', 'filtered_orders.muatype_id');
        })
        ->leftJoin('muatype_ratings', 'muatypes.id', '=', 'muatype_ratings.muatype_id')
        ->select(
            'muatypes.id',
            'muatypes.nama_mua as muatype_name',
            DB::raw('COUNT(filtered_orders.id) as total_orders'),
            DB::raw('AVG(muatype_ratings.rating) as average_rating')
        )
        ->groupBy('muatypes.id', 'muatypes.nama_mua')
        ->orderByDesc('total_orders')
        ->limit(10)
        ->get();

    return view('dashboard.customers.favorite', compact('favoriteMuaTypes', 'favoriteAdmins', 'totalOrders', 'totalPrice', 'totalCustomers', 'timePeriod'));
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
        // Validasi input
        $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'muatype_id' => 'required|exists:muatypes,id',
            'order_id' => 'required|exists:orders,id',
            'customer_id' => 'required|exists:users,id',
            'admin_rating' => 'required|integer|min:1|max:5',
            'admin_ulasan' => 'nullable|string',
            'muatype_rating' => 'required|integer|min:1|max:5',
            'muatype_ulasan' => 'nullable|string',
        ]);

        // Simpan rating untuk Admin
        AdminRating::create([
            'admin_id' => $request->admin_id,
            'customer_id' => $request->customer_id,
            'order_id' => $request->order_id,
            'rating' => $request->admin_rating,
            'review' => $request->admin_ulasan,
        ]);

        // Simpan rating untuk Muatype
        MuatypeRating::create([
            'muatype_id' => $request->muatype_id,
            'customer_id' => $request->customer_id,
            'order_id' => $request->order_id,
            'rating' => $request->muatype_rating,
            'review' => $request->muatype_ulasan,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $adminId)
    {
        

        

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
