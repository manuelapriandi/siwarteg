<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // Anda mungkin juga butuh accessor untuk tanggal pengajuan yang diformat
    public function getSubmissionDateLabelAttribute()
    {
        return \Carbon\Carbon::parse($this->submission_date)->format('d M Y, H:i:s');
    }
}