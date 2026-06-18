<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\RentalPackage;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPackages = RentalPackage::published()->with('console')->latest()->take(3)->get();
        $featuredGames = Game::published()->with('console')->latest()->take(6)->get();

        return view('home', compact('featuredPackages', 'featuredGames'));
    }
}
