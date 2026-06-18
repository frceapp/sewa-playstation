<?php

use App\Http\Controllers\Admin\ConsoleController as AdminConsoleController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\RentalPackageController as AdminRentalPackageController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog/paket-sewa', [CatalogController::class, 'packages'])->name('catalog.packages');
Route::get('/katalog/game', [CatalogController::class, 'games'])->name('catalog.games');
Route::get('/halaman/{slug}', [PageController::class, 'show'])->name('pages.show');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard', fn () => auth()->user()->is_admin ? to_route('admin.dashboard') : to_route('home'))
    ->middleware('auth')
    ->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', AdminDashboardController::class)->name('dashboard');
    Route::resource('pages', AdminPageController::class)->except('show');
    Route::resource('consoles', AdminConsoleController::class)->except('show');
    Route::resource('games', AdminGameController::class)->except('show');
    Route::resource('packages', AdminRentalPackageController::class)->except('show');
    Route::resource('messages', AdminMessageController::class)->only(['index', 'show', 'destroy']);
    Route::get('settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [AdminSettingController::class, 'update'])->name('settings.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
