<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $table = 'residents';

    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function complaints(){
        return $this->hasMany(Complaint::class);
    }

    public function ktpSubmissions()
    {
        return $this->hasMany(KtpSubmission::class);
    }
}
