<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Contoh struktur up()
public function up(): void
{
    Schema::create('ktp_submissions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('resident_id'); // Foreign key to residents table
        $table->string('document_proof')->nullable(); // Or more complex for multiple docs
        $table->text('notes')->nullable();
        $table->enum('status', ['baru', 'diproses', 'selesai', 'ditolak'])->default('baru');
        $table->text('admin_notes')->nullable();
        $table->timestamps();

        $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
    });
}
// Contoh struktur down()
public function down(): void
{
    Schema::dropIfExists('ktp_submissions');
}
};
