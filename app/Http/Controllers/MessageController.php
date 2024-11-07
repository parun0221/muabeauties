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

    $contacts = User::whereHas('sentMessages', function($query) use ($userId) {
        $query->where('receiver_id', $userId);
    })->orWhereHas('receivedMessages', function($query) use ($userId) {
        $query->where('sender_id', $userId);
    })->get();
    
    // Ambil pesan terakhir untuk setiap kontak dan jumlah pesan yang belum dibaca
    foreach ($contacts as $contact) {
        $contact->lastMessage = Message::where(function ($query) use ($userId, $contact) {
            $query->where('sender_id', $userId)->where('receiver_id', $contact->id);
        })->orWhere(function ($query) use ($userId, $contact) {
            $query->where('sender_id', $contact->id)->where('receiver_id', $userId);
        })->latest('created_at')->first();
    
        // Menambahkan jumlah pesan yang belum dibaca untuk kontak lain (yang menerima pesan)
        $contact->unreadCount = $contact->unreadMessagesCount()->where('sender_id', $userId)->count();
    }

    // Mengurutkan kontak berdasarkan waktu pesan terakhir
    $contacts = $contacts->sortByDesc(function ($contact) {
        return $contact->lastMessage->created_at ?? now(); // Atur default ke now jika tidak ada pesan
    });

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

        Message::where('sender_id', $userId)
        ->where('receiver_id', Auth::id())
        ->where('is_read', false)
        ->update(['is_read' => true]);
    
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
    public function getContacts()
{
    $userId = Auth::id();

    // Mengambil kontak yang pernah mengirim/diterima pesan dari pengguna
    $contacts = User::whereHas('sentMessages', function($query) use ($userId) {
        $query->where('receiver_id', $userId);
    })->orWhereHas('receivedMessages', function($query) use ($userId) {
        $query->where('sender_id', $userId);
    })->with(['lastMessage', 'unreadMessagesCount']) // Pastikan relasi ini ada
      ->get();

    // Ambil data tambahan untuk jumlah pesan yang belum dibaca
    foreach ($contacts as $contact) {
        $contact->unreadCount = Message::where('receiver_id', $contact->id)
                                        ->where('is_read', 0)
                                        ->count();
    }

    return response()->json($contacts);
}

}

