<?php

namespace Tests\Feature\Admin;

use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_area(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_regular_user_cannot_access_admin_area(): void
    {
        $this->actingAs(User::factory()->create())
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_admin_can_open_dashboard_and_create_a_page(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Ringkasan CMS');

        $this->actingAs($admin)->post('/admin/pages', [
            'title' => 'Cara Menyewa',
            'slug' => 'cara-menyewa',
            'content' => '<p>Pilih paket lalu hubungi kami.</p>',
            'sort_order' => 3,
            'show_in_navigation' => 1,
            'is_published' => 1,
        ])->assertRedirect(route('admin.pages.index'));

        $this->assertDatabaseHas('pages', [
            'slug' => 'cara-menyewa',
            'is_published' => true,
        ]);

        $this->get('/halaman/cara-menyewa')
            ->assertOk()
            ->assertSee('Pilih paket lalu hubungi kami.', false);
    }

    public function test_unpublished_page_is_not_available_publicly(): void
    {
        $page = Page::create([
            'title' => 'Draf',
            'slug' => 'draf',
            'content' => '<p>Belum terbit</p>',
            'sort_order' => 0,
            'show_in_navigation' => false,
            'is_published' => false,
        ]);

        $this->get('/halaman/'.$page->slug)->assertNotFound();
    }

    public function test_admin_can_update_site_settings(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        $payload = [
            'site_name' => 'Rental Console Bandung',
            'footer_text' => 'Rental Console Bandung. Hak cipta dilindungi.',
            'facebook_url' => 'https://facebook.com/rentalconsole',
            'instagram_url' => 'https://instagram.com/rentalconsole',
            'home_hero_title' => 'Main Tanpa Batas',
            'home_hero_highlight' => 'Langsung dari Rumah',
            'home_hero_description' => 'Sewa konsol dengan proses cepat.',
            'home_packages_title' => 'Paket Favorit',
            'home_packages_description' => 'Pilih paket sesuai kebutuhan.',
            'packages_title' => 'Harga Sewa',
            'packages_description' => 'Daftar paket rental terbaru.',
            'games_title' => 'Koleksi Game',
            'games_description' => 'Temukan game favorit Anda.',
            'contact_title' => 'Hubungi Rental',
            'contact_description' => 'Tim kami siap membantu.',
            'contact_address' => 'Bandung, Jawa Barat',
            'contact_phone' => '+62 812 0000 0000',
            'contact_email' => 'halo@example.com',
        ];

        $this->actingAs($admin)
            ->put('/admin/settings', $payload)
            ->assertSessionHasNoErrors();

        $this->assertSame('Rental Console Bandung', SiteSetting::where('key', 'site_name')->value('value'));
        $this->get('/')->assertOk()->assertSee('Main Tanpa Batas');
    }
}
