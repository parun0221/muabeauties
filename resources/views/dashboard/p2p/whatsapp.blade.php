@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="wa-chat-container">
    <div class="wa-contact-list">
        <h3>Chats</h3>
        <ul>
            @foreach($contacts as $contact)
                <li class="wa-contact-item" data-user-id="{{ $contact->id }}">
                    <img src="{{$contact->profile_photo ? asset('storage/' . $contact->profile_photo) : asset('/img/no-photo.png') }}" alt="{{ $contact->name }}">

                    <div class="wa-contact-info">
                        <h5>{{ $contact->name }}</h5>
                        <p>{{ $contact->last_message }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="wa-chat-box">
    @if(isset($selectedUser))
        <div class="wa-chat-header">
            <h5>Chat dengan {{ $selectedUser->name }}</h5>
        </div>

        <div class="wa-chat-messages">
            @foreach($messages as $message)
                <div class="wa-message {{ $message->sender_id == Auth::id() ? 'wa-sent' : 'wa-received' }}">
                    <p>{{ $message->message }}</p>
                    <small>{{ $message->created_at->format('H:i') }}</small>
                </div>
            @endforeach
        </div>

        <form id="message-form" action="{{ route('message.store') }}" method="POST" class="wa-form">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $selectedUser->id }}">
            <textarea name="message" placeholder="Type a message..." required></textarea>
            <button type="submit">Send</button>
        </form>
    @else
        <p>Select a contact to start chatting</p>
    @endif
</div>

</div>
<script>
    document.querySelectorAll('.contact-item').forEach(item => {
    item.addEventListener('click', function() {
        const userId = this.getAttribute('data-user-id');
        
        // Update nilai hidden input untuk receiver_id
        document.querySelector('input[name="receiver_id"]').value = userId;

        // Mengambil pesan untuk pengguna yang dipilih
        fetch(`/message/${userId}`)
            .then(response => response.json())
            .then(data => {
                const chatMessages = document.querySelector('.chat-messages');
                chatMessages.innerHTML = ''; // Kosongkan chat box
                data.messages.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.className = message.sender_id == {{ Auth::id() }} ? 'message sent' : 'message received';
                    messageElement.innerHTML = `<p>${message.message}</p><small>${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</small>`;
                    chatMessages.appendChild(messageElement);
                });
                document.querySelector('.chat-header h5').textContent = `Chat dengan ${data.contact.name}`;
            });
    });
});

// AJAX SENDING

document.getElementById('message-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Mencegah refresh halaman
    
    const formData = new FormData(this); // Ambil data dari formulir
    
    // Mengirim data formulir ke server
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest', // Agar Laravel mengenali permintaan AJAX
        },
    })
    .then(response => {
        if (response.ok) {
            return response.json(); // Mengembalikan response dalam format JSON
        }
        throw new Error('Network response was not ok.');
    })
    .then(data => {
        // Menambahkan pesan baru ke chat box
        const chatMessages = document.querySelector('.chat-messages');
        const messageElement = document.createElement('div');
        messageElement.className = 'message sent';
        messageElement.innerHTML = `<p>${data.message}</p><small>${new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</small>`;
        chatMessages.appendChild(messageElement);
        
        // Resetkan textarea setelah mengirim
        this.reset();
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
});

</script>
@endsection
