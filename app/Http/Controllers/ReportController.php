<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Admins;
use App\Models\AdminRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalaryReportExport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{

    $admin = Admins::with('user', 'order')->withCount('order')->get();

    // Total pendapatan dari pesanan yang sudah selesai
    $totalEarningsf = Order::where('status', 'finished')->sum('total_price');
    $totalEarningsc = Order::where('status', 'confirmed')->sum('total_price');
    $totalEarningsp = Order::where('status', 'pending')->sum('total_price');

    $totalEarningscl = Order::where('status', 'canceled')
    ->whereHas('payments', function ($query) {
        $query->where('order_id', '=', DB::raw('orders.id')); // Pastikan menggunakan hubungan yang tepat
    })
    ->sum('dp');



    // Jumlah pesanan aktif dan selesai
    $activeOrders = Order::where('status', 'confirmed')->count();

    $pendingOrders = Order::where('status',  'pending')->count();

    $completedOrders = Order::where('status', 'finished')->count();

    $cancelOrders = Order::where('status', 'canceled')->count();

    // MUA yang paling sering dipesan
    $popularMUA = Admins::select('admins.id', 'users.name as admin_name', 'users.profile_photo') // Ambil profile_photo dari users
    ->join('orders', 'admins.id', '=', 'orders.admin_id')
    ->join('users', 'admins.user_id', '=', 'users.id') // Gabungkan dengan tabel users
    ->selectRaw('COUNT(orders.id) as total_orders')
    ->groupBy('admins.id', 'users.name', 'users.profile_photo') // Tambahkan profile_photo dalam groupBy
    ->orderByDesc('total_orders') // Urutkan berdasarkan total orders, dari yang terbesar
    ->first(); // Ambil data pertama yang memiliki total pesanan terbanyak



    // MUA dengan review/ulasan terbanyak
    $mostReviewedMUA = Admins::select('admins.id', 'admins.user_id') // Menambahkan 'admins.user_id'
    ->join('admin_ratings', 'admins.id', '=', 'admin_ratings.admin_id')
    ->selectRaw('COUNT(admin_ratings.id) as total_reviews')
    ->groupBy('admins.id', 'admins.user_id') // Pastikan menambahkan 'admins.user_id' dalam GROUP BY
    ->orderBy('total_reviews', 'desc')
    ->first();

    $orders = Order::selectRaw('DATE(created_at) as date, COUNT(id) as total_orders')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $chartLabels = $orders->pluck('date');  // Tanggal sebagai label
    $chartData = $orders->pluck('total_orders');


    return view('dashboard.super.report', compact(
        'admin',
        'totalEarningsf',
        'totalEarningsp',
        'totalEarningsc',
        'activeOrders',
        'completedOrders',
        'popularMUA',
        'mostReviewedMUA',
        'chartLabels',
        'chartData',
        'pendingOrders',
        'totalEarningscl',
        'cancelOrders'
    ));
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
    $admin = Admins::with('user', 'order')->withCount('order')->findOrFail($id);

    // Ambil bulan dan tahun dari request (default: bulan dan tahun sekarang)
    $month = (int) request('month', now()->month);
$year = (int) request('year', now()->year);


    // Filter data berdasarkan bulan dan tahun
    $ordersQuery = $admin->order()->whereYear('booking_date', $year)->whereMonth('booking_date', $month);

    // Total pendapatan dari pesanan yang sudah selesai
    $totalEarningsf = (clone $ordersQuery)->where('status', 'finished')->sum('total_price');
    $totalEarningsc = (clone $ordersQuery)->where('status', 'confirmed')->sum('total_price');
    $totalEarningsp = (clone $ordersQuery)->where('status', 'pending')->sum('total_price');
    
    $totalEarningscl = (clone $ordersQuery)->where('status', 'canceled')
        ->whereHas('payments', function ($query) {
            $query->whereColumn('order_id', 'orders.id');
        })
        ->sum('dp');
    

    // Jumlah pesanan aktif dan selesai
    $activeOrders = (clone $ordersQuery)->where('status', 'confirmed')->count();
    $pendingOrders = (clone $ordersQuery)->where('status', 'pending')->count();
    $completedOrders = (clone $ordersQuery)->where('status', 'finished')->count();
    $cancelOrders = (clone $ordersQuery)->where('status', 'canceled')->count();

    $salary = ($totalEarningsf * 0.9) + ($totalEarningsc * 0.8);


    return view('dashboard.super.reportadmin', compact(
        'admin',
        'totalEarningsf',
        'totalEarningsp',
        'totalEarningsc',
        'activeOrders',
        'completedOrders',
        'pendingOrders',
        'totalEarningscl',
        'cancelOrders',
        'month',
        'year',
        'salary'
    ));
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

    public function exportPdf($adminId)
{
    $admin = Admins::findOrFail($adminId);
    $data = [
        'admin' => $admin,
        'completedOrders' => $completedOrders,
        'activeOrders' => $activeOrders,
        'pendingOrders' => $pendingOrders,
        'cancelOrders' => $cancelOrders,
        'salary' => $salary,
        // tambah data lain yang diperlukan
    ];

    $pdf = FacadePdf::loadView('reports.salary_report', $data);
    return $pdf->download('salary_report.pdf');
}

public function exportExcel($adminId)
{
    return Excel::download(new SalaryReportExport($adminId), 'salary_report.xlsx');
}

}
