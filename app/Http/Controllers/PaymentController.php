<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingPayments = Payment::where('status', 'pending')
        ->with(['order.customer']) // Include necessary relations
        ->get();

    return view('dashboard.p2p.chart', compact('pendingPayments'));
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
            'order_id' => 'required|exists:orders,id', // Order ID harus valid
            'payment_method' => 'required|string|max:255', // Metode pembayaran
            'payment_type' => 'required|in:dp,full', // Jenis pembayaran harus dp atau full
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Bukti pembayaran berupa gambar
        ]);

        // Upload file bukti pembayaran
        $proofPath = $request->file('payment_proof')->store('payments', 'public');

        // Simpan data pembayaran ke database
        Payment::create([
            'order_id' => $request->order_id,
            'payment_method' => $request->payment_method,
            'payment_type' => $request->payment_type,
            'payment_proof' => $proofPath,
            'status' => 'pending', // Default status
        ]);

        // Redirect atau respon JSON
        return redirect()->back()->with('success', 'Pembayaran berhasil dikirim. Menunggu verifikasi admin.');
    
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
    public function update(Request $request, $id)
    {
        // Validasi input request untuk memastikan status valid
        $request->validate([
            'status' => 'required|in:confirmed,cancelled',
        ]);

        // Temukan payment berdasarkan ID
        $payment = Payment::findOrFail($id);

        // Update status payment
        $payment->status = $request->status;

        // Update status pada order yang terkait
        $order = Order::findOrFail($payment->order_id);

        // Update status pada order (misalnya jika status confirmed, set status order menjadi completed)
        if ($request->status === 'confirmed') {
            $order->status = 'confirmed';  // Atau status lainnya sesuai dengan logika bisnis Anda
        } elseif ($request->status === 'cancelled') {
            $order->status = 'cancelled';  // Atau status lainnya sesuai dengan logika bisnis Anda
        }

        // Simpan perubahan pada payment dan order
        $payment->save();
        $order->save();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('order.index')->with('success', 'Status pembayaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
