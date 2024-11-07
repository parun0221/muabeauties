<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $orders = Order::with(['admin']) // Muat relasi customer dan user-nya
                        ->where('customer_id', $user->customer->id)
                        ->get();
        } elseif ($user->role === 'admin') {
            $orders = Order::with(['customer']) // Muat relasi customer dan user-nya
                        ->where('admin_id', $user->admin->id)
                        ->get();
        } else {
            $orders = collect(); // Kosongkan jika peran tidak diketahui
        }

    
    return view('dashboard.p2p.chart', compact('orders'));
    
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
        'total_price' => 'required|numeric',
        'depe' => 'required|numeric',
    ]);

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
        'total_price' => $request->total_price,
        'dp' => $request->depe,
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
