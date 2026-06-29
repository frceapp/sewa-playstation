<?php

namespace App\Http\Controllers;

use App\Models\Console;
use App\Models\Game;
use App\Models\RentalPackage;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function packages(Request $request)
    {
        $consoles = Console::all();
        $query = RentalPackage::published()->with('console');
        $selectedConsole = null;

        if ($request->filled('console')) {
            $selectedConsole = Console::where('slug', $request->console)->first();

            $query->whereHas('console', function ($q) use ($request) {
                $q->where('slug', $request->console);
            });
        }

        $packages = $query->get();

        return view('catalog.packages', compact('packages', 'consoles', 'selectedConsole'));
    }

    public function games(Request $request)
    {
        $consoles = Console::all();
        $query = Game::published()->with('console');
        $selectedConsole = null;

        if ($request->filled('console')) {
            $selectedConsole = Console::where('slug', $request->console)->first();

            $query->whereHas('console', function ($q) use ($request) {
                $q->where('slug', $request->console);
            });
        }

        // Pagination for games as they might be many
        $games = $query->paginate(12);

        return view('catalog.games', compact('games', 'consoles', 'selectedConsole'));
    }
}
