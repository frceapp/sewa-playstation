<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Console;
use App\Models\Game;
use App\Models\RentalPackage;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Pages
        Page::create([
            'title' => 'Syarat & Ketentuan',
            'slug' => 'syarat-ketentuan',
            'content' => "Syarat Umum\n\nPenyewa wajib memberikan jaminan berupa KTP asli yang masih berlaku.\n\nKetentuan Kerusakan\n\nSegala bentuk kerusakan yang terjadi selama masa sewa menjadi tanggung jawab penyewa sepenuhnya.",
        ]);

        Page::create([
            'title' => 'Tentang Kami',
            'slug' => 'tentang-kami',
            'content' => 'Kami adalah penyedia layanan sewa PlayStation terpercaya yang beroperasi sejak tahun 2023. Kami selalu memastikan unit konsol yang kami sewakan dalam kondisi prima, bersih, dan siap main.',
        ]);

        // 2. Consoles
        $ps4 = Console::create([
            'name' => 'PlayStation 4',
            'slug' => 'playstation-4',
            'description' => 'Konsol generasi ke-4 dari Sony, cocok untuk game kasual.',
        ]);

        $ps5 = Console::create([
            'name' => 'PlayStation 5',
            'slug' => 'playstation-5',
            'description' => 'Konsol generasi terbaru dengan grafis memukau dan loading super cepat.',
        ]);

        // 3. Rental Packages
        RentalPackage::create([
            'console_id' => $ps4->id,
            'name' => 'Paket PS4 Harian',
            'price' => 75000,
            'features' => '1 Unit Konsol PS4, 2 Stik DualShock 4, 3 Game Pilihan, Kabel Lengkap',
        ]);

        RentalPackage::create([
            'console_id' => $ps5->id,
            'name' => 'Paket PS5 Premium',
            'price' => 150000,
            'features' => '1 Unit Konsol PS5, 2 Stik DualSense, 5 Game Pilihan, Kabel Lengkap, Gratis Antar-Jemput',
        ]);

        // 4. Games
        Game::create([
            'console_id' => $ps4->id,
            'title' => 'FIFA 23',
            'slug' => 'fifa-23-ps4',
            'genre' => 'Sports',
        ]);

        Game::create([
            'console_id' => $ps4->id,
            'title' => 'GTA V',
            'slug' => 'gta-v-ps4',
            'genre' => 'Action Adventure',
        ]);

        Game::create([
            'console_id' => $ps5->id,
            'title' => 'EA FC 24',
            'slug' => 'ea-fc-24-ps5',
            'genre' => 'Sports',
        ]);

        Game::create([
            'console_id' => $ps5->id,
            'title' => 'Spider-Man 2',
            'slug' => 'spider-man-2-ps5',
            'genre' => 'Action Adventure',
        ]);
    }
}
