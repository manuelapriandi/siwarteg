<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Pastikan Carbon diimpor jika belum

class KtpSubmission extends Model
{
    use HasFactory;

    protected $guarded = []; // Sesuaikan jika ingin menggunakan $fillable

    // Relasi ke Resident
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    // Accessor untuk label status
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'baru' => 'Baru',
            'diproses' => 'Sedang Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => 'Tidak Diketahui',
        };
    }

    // Accessor untuk warna status (sesuaikan dengan Tailwind/Bootstrap Anda)
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'baru' => 'info',      // Biru muda
            'diproses' => 'warning', // Kuning
            'selesai' => 'success', // Hijau
            'ditolak' => 'danger',   // Merah
            default => 'secondary',  // Abu-abu
        };
    }

    // Accessor untuk label jenis pengajuan (INI YANG HILANG)
    public function getSubmissionTypeLabelAttribute()
{
    return match ($this->submission_type) {
        'KK' => 'Kartu Keluarga',
        'KTP' => 'Kartu Tanda Penduduk',
        'akta kelahiran' => 'Akta Kelahiran',
        'akta kematian' => 'Akta Kematian',
        'SKCK' => 'SKCK',
        default => 'Tidak Diketahui',
    };
}

    // Accessor untuk tanggal pengajuan yang diformat
    public function getSubmissionDateLabelAttribute()
    {
        // Pastikan kolom 'submission_date' ada di tabel database Anda
        return Carbon::parse($this->created_at)->format('d M Y, H:i:s'); // Biasanya pakai created_at untuk tanggal pengajuan
    }
}