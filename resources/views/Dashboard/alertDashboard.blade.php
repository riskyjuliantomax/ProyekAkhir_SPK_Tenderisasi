@if (count($notifikasi) > 0)
    <div class="alert alert-success alert-dismissible">
        <ul>
            @foreach ($notifikasi as $notif)
                <li class="text-black">{{ $notif->pesan_notifikasi }}, Silakan Periksa Di Riwayat Anda</li>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </ul>
    </div>
@endif
