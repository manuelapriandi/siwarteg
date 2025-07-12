<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ktp_submissions', function (Blueprint $table) {
            $table->string('surat_pengantar_path')->nullable()->after('admin_notes');
        });
    }
    public function down(): void
    {
        Schema::table('ktp_submissions', function (Blueprint $table) {
            $table->dropColumn('surat_pengantar_path');
        });
    }
};