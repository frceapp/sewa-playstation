<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('show_in_navigation')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
        });

        Schema::table('games', function (Blueprint $table) {
            $table->boolean('is_published')->default(true);
        });

        Schema::table('rental_packages', function (Blueprint $table) {
            $table->boolean('is_published')->default(true);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->timestamp('read_at')->nullable();
        });

        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');

        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('read_at');
        });

        Schema::table('rental_packages', function (Blueprint $table) {
            $table->dropColumn('is_published');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('is_published');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['show_in_navigation', 'sort_order', 'is_published']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
};
