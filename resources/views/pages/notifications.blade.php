@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Semua Notifikasi</h1>
</div>

<div class="row">
    @forelse (auth()->user()->notifications as $notification)
    <div class="col-12 mb-2">
        <div class="card">
            <div class="card-body" style="background-color: rgba(115, 194, 251, {{is_null($notification->read_at) ? '0.13' : '0.0' }})">
                <div class="row align-items-center"> {{-- Added align-items-center for vertical alignment --}}
                    <div class="col-1">{{ $loop->iteration }}</div>
                    <div class="col-8"> {{-- Changed to col-8 to make space for date and action --}}
                        @php
                            $notificationData = $notification->data;
                            $message = $notificationData['message'] ?? 'Pesan notifikasi tidak tersedia.';
                            $link = '#'; // Default link
                            $iconClass = 'fas fa-bell'; // Default icon
                            $bgColor = 'bg-secondary'; // Default background color for icon

                            if (isset($notificationData['type'])) {
                                if ($notificationData['type'] == 'ktp_submission_status_changed') {
                                    $link = '/ktp-submission/' . ($notificationData['ktp_submission_id'] ?? '');
                                    $iconClass = 'fas fa-id-card';
                                    $bgColor = 'bg-primary';
                                } elseif ($notificationData['type'] == 'complaint_status_changed') { // Asumsi Anda menambahkan 'type' untuk Complaint juga
                                    $link = '/complaint/' . ($notificationData['complaint_id'] ?? '');
                                    $iconClass = 'fas fa-scroll';
                                    $bgColor = 'bg-info';
                                }
                            } else {
                                // Fallback for old complaint notifications if 'type' is not set
                                if (isset($notificationData['complaint_id'])) {
                                    $link = '/complaint/' . ($notificationData['complaint_id'] ?? '');
                                    $iconClass = 'fas fa-scroll';
                                    $bgColor = 'bg-info';
                                }
                            }
                        @endphp
                        <div class="d-flex align-items-center">
                            <div class="icon-circle {{ $bgColor }} mr-3">
                                <i class="{{ $iconClass }} text-white"></i>
                            </div>
                            <div>
                                <div class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                                <span class="font-weight-bold">{{ $message }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 text-right"> {{-- Changed to col-3 and text-right --}}
                        @if (is_null($notification->read_at))
                        <form action="/notification/{{$notification->id}}/read" method="post">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-primary btn-block">Tandai dibaca</button>
                        </form>
                        @else
                        <span class="text-muted small">Sudah dibaca</span>
                        @endif
                        <a href="{{ $link }}" class="btn btn-sm btn-outline-secondary btn-block mt-1">Lihat Detail</a> {{-- Added detail link --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center">
                <p class="mb-0">Tidak ada notifikasi.</p>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection