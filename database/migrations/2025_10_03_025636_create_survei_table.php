<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surveis', function (Blueprint $table) {
            $table->id();

            // Data Diri
            $table->string('nama_lengkap');
            $table->string('email')->nullable(); // Opsional
            $table->string('pekerjaan');
            $table->string('jenis_kelamin');
            $table->string('pendidikan');
            $table->string('jenis_layanan');

            // Pertanyaan Survei (Q1 - Q9)
            // Menggunakan string karena jawabannya teks (misal: "Sangat Sesuai")
            $table->string('q1_kesesuaian_persyaratan');
            $table->string('q2_kemudahan_prosedur');
            $table->string('q3_kecepatan');
            $table->string('q4_kewajaran_biaya');
            $table->string('q5_kompetensi');
            $table->string('q6_kesesuaian_produk');
            $table->string('q7_perilaku');
            $table->string('q8_sarpras');
            $table->string('q9_pengaduan');

            // Saran
            $table->text('saran');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Perbaikan: sesuaikan nama tabel dengan create di atas ('surveis')
        Schema::dropIfExists('surveis');
    }
};