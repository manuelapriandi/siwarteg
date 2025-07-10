@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <h4 class="welcome-text">Selamat datang,</h4>
        <h2 class="username"><b>{{ auth()->user()->name }}...</b></h2>
        <p class="welcome-message">
            @php
                // Set locale to Indonesian
                setlocale(LC_TIME, 'id_ID.utf8', 'id_ID', 'id');

                // Format date in Indonesian
                echo strftime('%A, %d %B %Y');
            @endphp
        </p>
    </div>

    <!-- Complaint Status Cards -->
    <div class="section-header">
        <h1>{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Aduan Warga' : 'Status Aduan Anda' }}</h1>
    </div>

    <div class="row card-row">
        <!-- Total Complaints Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Total Aduan Warga' : 'Total Aduan Anda' }}
                            </div>
                            <div class="card-value">{{ $totalAduan }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Complaints Card (Admin Only) -->
        @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">Aduan Baru</div>
                            <div class="card-value">{{ $aduanBaru }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-info" style="width: {{ $totalAduan ? ($aduanBaru/$totalAduan)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- In Progress Complaints Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Sedang diproses' : 'Sedang diproses Pak RT/RW' }}
                            </div>
                            <div class="card-value">{{ $aduanDiproses }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-spinner fa-pulse"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-warning" style="width: {{ $totalAduan ? ($aduanDiproses/$totalAduan)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Complaints Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Selesai' : 'Diselesaikan Pak RT/RW' }}
                            </div>
                            <div class="card-value">{{ $aduanSelesai }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-success" style="width: {{ $totalAduan ? ($aduanSelesai/$totalAduan)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- --- START KTP Submission Status Cards --- --}}
    <div class="section-header">
        <h1>{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Pengajuan Berkas Warga' : 'Status Pengajuan Berkas Anda' }}</h1>
    </div>

    <div class="row card-row">
        <!-- Total KTP Submissions Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Total Pengajuan Berkas' : 'Total Pengajuan Berkas Anda' }}
                            </div>
                            <div class="card-value">{{ $totalKtpSubmissions }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-file-alt"></i> {{-- Icon for documents/submissions --}}
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New KTP Submissions Card (Admin Only) -->
        @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">Pengajuan Berkas Baru</div>
                            <div class="card-value">{{ $ktpSubmissionsBaru }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-folder-plus"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-info" style="width: {{ $totalKtpSubmissions ? ($ktpSubmissionsBaru/$totalKtpSubmissions)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- In Progress KTP Submissions Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Sedang Diproses' : 'Sedang Diproses Pak RT/RW' }}
                            </div>
                            <div class="card-value">{{ $ktpSubmissionsDiproses }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-warning" style="width: {{ $totalKtpSubmissions ? ($ktpSubmissionsDiproses/$totalKtpSubmissions)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed KTP Submissions Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Selesai' : 'Diselesaikan Pak RT/RW' }}
                            </div>
                            <div class="card-value">{{ $ktpSubmissionsSelesai }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-check-double"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-success" style="width: {{ $totalKtpSubmissions ? ($ktpSubmissionsSelesai/$totalKtpSubmissions)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rejected KTP Submissions Card (Admin Only, or for User to see their rejected) -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Ditolak' : 'Ditolak Pak RT/RW' }}
                            </div>
                            <div class="card-value">{{ $ktpSubmissionsDitolak }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-danger" style="width: {{ $totalKtpSubmissions ? ($ktpSubmissionsDitolak/$totalKtpSubmissions)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- --- END KTP Submission Status Cards --- --}}


    <!-- Recent Activity Section -->
    <div class="section-header">
        <h1>Aktivitas Terkini</h1>
    </div>
    <div class="card recent-activity-card mb-4">
        <div class="card-body">
            <div class="activity-list">
                {{-- Recent Complaints --}}
                @forelse ($aduanTerbaru as $aduan)
                <div class="activity-item">
                    <div class="activity-icon bg-info">
                        <i class="fas fa-scroll"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Aduan baru: <b>{{ $aduan->title }}</b> oleh {{ $aduan->resident->nama ?? 'Warga Tidak Dikenal' }}</div>
                        <div class="activity-time">{{ $aduan->report_date_label }}</div>
                    </div>
                </div>
                @empty
                    <div class="activity-item">
                        <div class="activity-content">
                            <div class="activity-text">Tidak ada aduan terbaru.</div>
                        </div>
                    </div>
                @endforelse

                {{-- Recent KTP Submissions --}}
                @forelse ($ktpSubmissionsTerbaru as $submission)
                <div class="activity-item">
                    <div class="activity-icon bg-primary">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Pengajuan <b>{{ $submission->submission_type_label }}</b> oleh {{ $submission->resident->nama ?? 'Warga Tidak Dikenal' }} - Status: <span class="badge badge-{{ $submission->status_color }}">{{ $submission->status_label }}</span></div>
                        <div class="activity-time">{{ $submission->submission_date_label }}</div>
                    </div>
                </div>
                @empty
                    <div class="activity-item">
                        <div class="activity-content">
                            <div class="activity-text">Tidak ada pengajuan berkas terbaru.</div>
                        </div>
                    </div>
                @endforelse

                {{-- You can add other recent activities here --}}
                <div class="activity-item">
                    <div class="activity-icon bg-secondary">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Sistem telah diperbarui</div>
                        <div class="activity-time">Hari ini, 10:30</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Other Sections (Placeholders) -->
    <div class="section-header">
        <h1>{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Iuran Bulanan Warga' : 'Status Iuran Bulanan Anda' }}</h1>
    </div>
    <div class="placeholder-section">
        <p>Informasi iuran akan ditampilkan di sini</p>
    </div>
</div>

<style>
    /* Modern Dashboard Styles */
    .dashboard-container {
        padding: 20px;
    }

    .welcome-section {
        margin: 20px 0 30px;
        padding: 20px;
        background: linear-gradient(135deg, #e2ebf3 0%, #95c6f8 100%);
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .welcome-text {
        color: #6c757d;
        margin-bottom: 5px;
    }

    .username {
        color: #343a40;
        margin-bottom: 5px;
    }

    .welcome-message {
        color: #6c757d;
        font-style: italic;
    }

    .section-header {
        margin: 30px 0 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .section-header h1 {
        color: #495057;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .status-card {
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .status-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .card-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #719abe;
        margin-bottom: 5px;
    }

    .card-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #343a40;
    }

    .card-icon {
        font-size: 2.5rem;
        opacity: 0.2;
        margin-left: 15px;
    }

    .progress {
        height: 5px;
        border-radius: 2.5px;
        background-color: #e9ecef;
    }

    .recent-activity-card {
        border-radius: 10px;
        border: none;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }

    .activity-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f1f1f1;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
    }

    .activity-text {
        font-weight: 500;
        color: #495057;
    }

    .activity-time {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .placeholder-section {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        text-align: center;
        color: #6c757d;
    }

    @media (max-width: 768px) {
        .card-value {
            font-size: 1.5rem;
        }

        .card-icon {
            font-size: 2rem;
        }
    }
</style>
@endsection