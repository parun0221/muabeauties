<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $userId = Auth::id();

    // Ambil kontak yang pernah mengirim/diterima pesan dari pengguna
    $contacts = User::whereHas('sentMessages', function($query) use ($userId) {
        $query->where('receiver_id', $userId);
    })->orWhereHas('receivedMessages', function($query) use ($userId) {
        $query->where('sender_id', $userId);
    })->get();

    // Periksa apakah ada kontak
    $selectedUser = $contacts->first(); // Mengambil kontak pertama jika ada
    $messages = collect(); // Default sebagai koleksi kosong

    // Jika ada kontak yang dipilih, ambil pesan
    if ($selectedUser) {
        $messages = Message::where(function($query) use ($userId, $selectedUser) {
            $query->where('sender_id', $userId)->where('receiver_id', $selectedUser->id);
        })->orWhere(function($query) use ($userId, $selectedUser) {
            $query->where('sender_id', $selectedUser->id)->where('receiver_id', $userId);
        })->get();
    }

    return view('dashboard.p2p.whatsapp', compact('contacts', 'selectedUser', 'messages'));
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
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required|string',
    ]);

    $message = Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
    ]);

    return response()->json($message); // Mengembalikan pesan yang baru dikirim dalam format JSON
}


    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $messages = Message::where(function($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
        })->get();
    
        $contact = User::find($userId);
    
        return response()->json(['messages' => $messages, 'contact' => $contact]);
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
    public function getMessages($userId)
{
    $messages = Message::where(function($query) use ($userId) {
        $query->where('sender_id', Auth::id())
              ->where('receiver_id', $userId);
    })->orWhere(function($query) use ($userId) {
        $query->where('sender_id', $userId)
              ->where('receiver_id', Auth::id());
    })->get();

    $contact = User::find($userId);

    return response()->json(['messages' => $messages, 'contact' => $contact]);
}
}

