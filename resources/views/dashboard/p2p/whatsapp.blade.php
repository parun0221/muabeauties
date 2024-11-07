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
            <p>{{ $contact->lastMessage ? $contact->lastMessage->message : 'Tidak ada pesan' }}</p>
            @if($contact->unreadCount > 0)
                <span class="badge">{{ $contact->unreadCount }}</span> <!-- Menampilkan jumlah pesan yang belum dibaca -->
            @endif
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
    document.querySelectorAll('.wa-contact-item').forEach(item => {
    item.addEventListener('click', function() {
        const userId = this.getAttribute('data-user-id');
        
        // Update nilai hidden input untuk receiver_id
        document.querySelector('input[name="receiver_id"]').value = userId;

        // Mengambil pesan untuk pengguna yang dipilih
        fetch(`/message/${userId}`)
            .then(response => response.json())
            .then(data => {
                const chatMessages = document.querySelector('.wa-chat-messages');
                chatMessages.innerHTML = ''; // Kosongkan chat box
                data.messages.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.className = message.sender_id == {{ Auth::id() }} ? 'wa-message wa-sent' : 'wa-message wa-received';
                    messageElement.innerHTML = `<p>${message.message}</p><small>${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</small>`;
                    chatMessages.appendChild(messageElement);
                });
                document.querySelector('.wa-chat-header h5').textContent = `Chat dengan ${data.contact.name}`;
            })
            .catch(error => console.error('Fetch error:', error));
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
        const chatMessages = document.querySelector('.wa-chat-messages');
        const messageElement = document.createElement('div');
        messageElement.className = 'wa-message wa-sent';
        messageElement.innerHTML = `<p>${data.message}</p><small>${new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</small>`;
        chatMessages.appendChild(messageElement);
        
        // Resetkan textarea setelah mengirim
        this.reset();

        updateContactList();
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
});

// Fungsi untuk memperbarui daftar kontak
function updateContactList() {
    fetch('/contacts')
        .then(response => response.json())
        .then(contacts => {
            console.log('Contacts:', contacts); // Lihat data yang diterima
            const contactList = document.querySelector('.wa-contact-list ul');
            contactList.innerHTML = ''; // Kosongkan daftar kontak

            contacts.forEach(contact => {
                const listItem = document.createElement('li');
                listItem.className = 'wa-contact-item';
                listItem.setAttribute('data-user-id', contact.id);
                
                listItem.innerHTML = `
                    <img src="${contact.profile_photo ? '/storage/' + contact.profile_photo : '/img/no-photo.png'}" alt="${contact.name}">
                    <div class="wa-contact-info">
                        <h5>${contact.name}</h5>
                        <p>${contact.lastMessage ? contact.lastMessage.message : 'Tidak ada pesan'}</p>
                        ${contact.unreadCount > 0 ? `<span class="badge">${contact.unreadCount}</span>` : ''}
                    </div>
                `;

                contactList.appendChild(listItem);
            });
        })
        .catch(error => console.error('Error fetching contacts:', error));
}


</script>
@endsection
