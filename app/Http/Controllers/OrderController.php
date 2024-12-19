<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Admins;
use App\Models\Message;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingPayments = Payment::where('status', 'pending')
        ->with(['order.customer']) // Include necessary relations
        ->get();
        $user = Auth::user();

        $totalOrders = Order::count();
        $totalPrice = Order::sum('total_price');
        $totalCustomers = Order::distinct('customer_id')->count('customer_id');

        if ($user->role === 'customer' && $user->customer) {
            // Menampilkan pesanan berdasarkan status
            $pendingOrders = Order::where('customer_id', $user->customer->id)
                ->where('status', 'pending')
                ->with('admin')
                ->get();
    
            $confirmedOrders = Order::where('customer_id', $user->customer->id)
                ->where('status', 'confirmed')
                ->with('admin')
                ->get();
    
            $finishedOrders = Order::where('customer_id', $user->customer->id)
                ->where('status', 'finished')
                ->with('admin')
                ->get();
    
            // Menggabungkan semua pesanan berdasarkan status
            $orders = [
                'pending' => $pendingOrders,
                'confirmed' => $confirmedOrders,
                'finished' => $finishedOrders,
            ];
        } elseif ($user->role === 'admin') {
            $orders = Order::with(['customer']) // Muat relasi customer dan user-nya
                        ->where('admin_id', $user->admin->id)
                        ->get();
        }  elseif ($user->role === 'super admin') {
            // Super admin dapat melihat semua pesanan
            $orders = Order::with(['customer', 'admin']) // Muat relasi customer dan admin
                        ->get();
        }else {
            $orders = collect(); // Kosongkan jika peran tidak diketahui
        }

    
    return view('dashboard.p2p.chart', compact('orders', 'totalOrders', 'totalPrice', 'totalCustomers', 'pendingPayments'));
    
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
        'adminbooking_id' => 'required|exists:admins,id',
        'muatype_id' => 'required|exists:muatypes,id',
        'booking_date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
        'total_price' => 'required',
        'depe' => 'required',
    ]);

    $totalPrice = $request->total_price;
$depe = $request->depe;

// Pastikan format total price dan depe adalah angka tanpa titik
$totalPrice = str_replace(',', '', $totalPrice); // Menghapus koma jika ada
$depe = str_replace(',', '', $depe); // Menghapus koma jika ada

    // Log data untuk debugging
    Log::info('Data Pesanan:', $request->all());

    // Simpan data pesanan ke tabel orders
    Order::create([
        'customer_id' => Auth::id(),
        'admin_id' => $request->adminbooking_id,
        'muatype_id' => $request->muatype_id,
        'booking_date' => $request->booking_date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'total_price' => $totalPrice,
        'dp' => $depe,
        'status' => 'pending',
    ]);

    // Pesan untuk admin
    $messageContent = "Pesanan baru dari " . Auth::user()->name . ":\n" .
                      "Jenis Layanan: " . $request->muatype_id . "\n" .
                      "Tanggal Pemesanan: " . $request->booking_date . "\n" .
                      "Jam Mulai: " . $request->start_time . "\n" .
                      "Jam Berakhir: " . $request->end_time . "\n" .
                      "Total Harga: " . $request->total_price . "\n" .
                      "DP: " . $request->depe;

                      $admin = Admins::find($request->adminbooking_id);
    
                      // Ambil ID user yang terhubung dengan admin
                      $receiverId = $admin->user->id;

    Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $receiverId,
        'message' => $messageContent,
    ]);

    return redirect()->back()->with('success', 'Pemesanan berhasil dilakukan.');
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
        $order = Order::findOrFail($id);
         return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'booking_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'total_price' => 'required',
            'dp' => 'required',
        ]);

        $order = Order::findOrFail($id);

    // Update data berdasarkan input
    $order->update([
        'booking_date' => $request->booking_date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'total_price' => $request->total_price,
        'dp' => $request->dp,
    ]);

    // Redirect atau kembalikan respon
    return redirect()->back()->with('success', 'Data booking berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getSchedule(Request $request)
    {
        // Mengambil pesanan dalam rentang tanggal yang diberikan
        $start = $request->start;
        $end = $request->end;
        
        $orders = Order::whereBetween('booking_date', [$start, $end])
                       ->get()
                       ->map(function ($order) {
                           return [
                               'title' => 'Pesanan: ' . $order->start_time . ' - ' . $order->jend_time,
                               'start' => $order->booking_date . 'T' . $order->start_time,
                               'end' => $order->booking_date . 'T' . $order->end_time,
                           ];
                       });

        return response()->json($orders);
    }

    // Mengambil pesanan berdasarkan tanggal
    public function getOrdersByDate(Request $request)
{
    $admin_id = $request->admin_id; 
    $date = $request->date; // Tanggal yang dipilih

    // Pastikan tanggal dalam format yang benar (YYYY-MM-DD)
    $formattedDate = \Carbon\Carbon::parse($date)->format('Y-m-d');

    // Mengambil pesanan untuk tanggal tertentu
    $orders = Order::where('admin_id', $admin_id)->whereDate('booking_date', $formattedDate)->get();

    // Debug: periksa query
    Log::info('Tanggal yang dipilih: ' . $formattedDate);
    Log::info('Pesanan yang ditemukan: ', $orders->toArray());

    // Mengembalikan data pesanan dalam format JSON
    return response()->json($orders);
}

public function cancelOrder($id)
{
    try {
        // Cari order berdasarkan ID
        $order = Order::findOrFail($id);

        // Perbarui status menjadi "canceled"
        $order->status = 'canceled';
        $order->save();

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil dibatalkan.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Gagal membatalkan pesanan.']);
    }
}

public function finishOrder($id)
{
    try {
        // Cari pesanan berdasarkan ID
        $order = Order::findOrFail($id);

        // Perbarui status menjadi 'finished'
        $order->status = 'finished';
        $order->save();

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil diselesaikan.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Gagal menyelesaikan pesanan.']);
    }
}


// SUPER ADMIN

public function getTodayOrdersAndRevenue()
    {
        $today = Carbon::today();
        $todayOrders = Order::whereDate('created_at', $today)->count();
        $todayRevenue = Order::whereDate('created_at', $today)->sum('total_price'); // Misalnya 'total_price' ada pada tabel order

        return response()->json([
            'todayOrders' => $todayOrders,
            'todayRevenue' => $todayRevenue
        ]);
    }

    // Ambil statistik pesanan dan pemasukan bulan ini
    public function getMonthlyOrdersAndRevenue()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $monthlyOrders = Order::whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
        $monthlyRevenue = Order::whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('total_price');

        return response()->json([
            'monthlyOrders' => $monthlyOrders,
            'monthlyRevenue' => $monthlyRevenue
        ]);
    }

    // Ambil data pesanan berdasarkan bulan tertentu
    public function getOrdersByMonth(Request $request)
    {
        $ordersByMonth = Order::whereMonth('created_at', $request->month)
            ->whereYear('created_at', $request->year)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            })
            ->map(function($dayOrders) {
                return $dayOrders->count();
            });

        return response()->json(['orders' => $ordersByMonth]);
    }

    // Ambil data pesanan berdasarkan tahun tertentu
    public function getOrdersByYear(Request $request)
    {
        $ordersByYear = Order::whereYear('created_at', $request->year)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('m');
            })
            ->map(function($monthOrders) {
                return $monthOrders->count();
            });

        return response()->json(['orders' => $ordersByYear]);
    }


    
}
