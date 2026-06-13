<?php

namespace App\Http\Controllers;

use App\Models\RentalPackage;
use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPackages = RentalPackage::with('console')->take(3)->get();
        $featuredGames = Game::with('console')->take(6)->get();

        return view('home', compact('featuredPackages', 'featuredGames'));
    }
}
