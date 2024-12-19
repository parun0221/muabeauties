<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month); // Default to current month
        $year = $request->input('year', Carbon::now()->year); // Default to current year

        // Ambil data pesanan berdasarkan bulan dan tahun yang dipilih
        $monthlyOrders = $this->getMonthlyOrders($month, $year);
    
        // Kirim data ke view
        return view('dashboard.dashboard', compact('monthlyOrders', 'month', 'year'));
    }

    public function getMonthlyOrders($month, $year)
{
    // Ambil semua tanggal dalam bulan
    $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth; // Hitung total hari dalam bulan
    $dates = collect();
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $dates->put(Carbon::createFromDate($year, $month, $i)->format('Y-m-d'), 0);
    }

    

    // Ambil data pesanan dari database
    $orders = Order::whereMonth('created_at', $month)
                   ->whereYear('created_at', $year)
                   ->get()
                   ->groupBy(function ($order) {
                       return Carbon::parse($order->created_at)->format('Y-m-d');
                   })
                   ->map(function ($dayOrders) {
                       return $dayOrders->count();
                   });

    // Gabungkan data pesanan dengan tanggal (tanggal tanpa pesanan diisi 0)
    $completeData = $dates->merge($orders);

    return $completeData->toArray();
}


}


?>