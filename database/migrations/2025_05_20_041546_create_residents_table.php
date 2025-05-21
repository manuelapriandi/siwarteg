<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16);
            $table->string('nama', 95);
            $table->enum('jk', ['Laki-laki','Perempuan']);
            $table->date('tgl_lahir');
            $table->string('tmpt_lahir', 100);
            $table->text('alamat');
            $table->string('agama', 40)->nullable();
            $table->enum('status_kwn',['Belum Menikah', 'Menikah', 'Cerai', 'Ibu/Bapak Tunggal']);
            $table->string('pekerjaan', 65)->nullable();
            $table->string('notelp', 15)->nullable();
            $table->enum('status', ['aktif', 'pindah', 'meninggal'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
