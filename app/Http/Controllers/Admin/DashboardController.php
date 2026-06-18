<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Models\Game;
use App\Models\Message;
use App\Models\Page;
use App\Models\RentalPackage;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'counts' => [
                'pages' => Page::count(),
                'packages' => RentalPackage::count(),
                'games' => Game::count(),
                'consoles' => Console::count(),
                'messages' => Message::whereNull('read_at')->count(),
            ],
            'latestMessages' => Message::latest('created_at')->take(5)->get(),
        ]);
    }
}
