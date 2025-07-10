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
        Schema::table('ktp_submissions', function (Blueprint $table) {
            $table->enum('submission_type', [
                'KK',
                'KTP',
                'akta kelahiran',
                'akta kematian',
                'SKCK'
            ])->after('resident_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ktp_submissions', function (Blueprint $table) {
            // Hapus kolom 'submission_type' jika migrasi di-rollback
            $table->dropColumn('submission_type');
        });
    }
};
