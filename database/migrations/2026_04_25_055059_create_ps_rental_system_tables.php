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
        // 1. Tabel Consoles (Sebagai Kategori Utama)
        Schema::create('consoles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Games (Berelasi ke Consoles)
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke id di tabel consoles
            $table->foreignId('console_id')->constrained('consoles');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('genre')->nullable();
            $table->timestamps();
        });

        // 3. Tabel Rental Packages (Harga Sewa)
        Schema::create('rental_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('console_id')->constrained('consoles');
            $table->string('name');
            $table->integer('price');
            $table->text('features')->nullable(); // Misal: "Include 2 Stick + Full Game"
            $table->timestamps();
        });

        // 4. Tabel Pages (Untuk Konten Statis: About, Rules, dll)
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('content');
            $table->timestamps();
        });

        // 5. Tabel Messages (Input dari Form Kontak)
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->text('content');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('rental_packages');
        Schema::dropIfExists('games');
        Schema::dropIfExists('consoles');
    }
};