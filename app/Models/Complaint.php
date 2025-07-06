<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $guarded = [];

    public function getStatusLabelAttribute() // status_label
    {
        return match ($this->status){
            'baru' => 'Baru',
            'diproses' => 'Sedang proses',
            'selesai' => 'Selesai',
            default => 'Tidak Diketahui'
        };  
    }

    public function getReportDateLabelAttribute(){ //report_date_label
        return \Carbon\Carbon::parse($this->report_date)->format('d M Y, H:i:s');
    }

    public function getStatusColorAttribute(){ // status_color
        return match ($this->status){
            'baru' => 'info',
            'diproses' => 'warning',
            'selesai' => 'success',
            default => 'secondary',
        };  

    }

    public function resident(){
        return $this->belongsTo(Resident::class);
    }
}
