<?php

namespace App\Http\Controllers;

use App\Models\RentalPackage;
use App\Models\Game;
use App\Models\Console;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function packages(Request $request)
    {
        $consoles = Console::all();
        $query = RentalPackage::with('console');
        
        if ($request->has('console')) {
            $query->whereHas('console', function($q) use ($request) {
                $q->where('slug', $request->console);
            });
        }

        $packages = $query->get();

        return view('catalog.packages', compact('packages', 'consoles'));
    }

    public function games(Request $request)
    {
        $consoles = Console::all();
        $query = Game::with('console');

        if ($request->has('console')) {
            $query->whereHas('console', function($q) use ($request) {
                $q->where('slug', $request->console);
            });
        }

        // Pagination for games as they might be many
        $games = $query->paginate(12);

        return view('catalog.games', compact('games', 'consoles'));
    }
}
