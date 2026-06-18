<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $games = Game::with('console')
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%'.$request->string('q').'%'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        return view('admin.games.create', ['game' => new Game, 'consoles' => Console::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['image'] = $request->file('image')?->store('games', 'public');
        Game::create($data);

        return to_route('admin.games.index')->with('success', 'Game berhasil ditambahkan.');
    }

    public function edit(Game $game)
    {
        return view('admin.games.edit', ['game' => $game, 'consoles' => Console::orderBy('name')->get()]);
    }

    public function update(Request $request, Game $game)
    {
        $data = $this->validated($request, $game);
        if ($request->hasFile('image')) {
            if ($game->image) {
                Storage::disk('public')->delete($game->image);
            }
            $data['image'] = $request->file('image')->store('games', 'public');
        }
        if ($request->boolean('remove_image')) {
            if ($game->image) {
                Storage::disk('public')->delete($game->image);
            }
            $data['image'] = null;
        }
        $game->update($data);

        return to_route('admin.games.index')->with('success', 'Game berhasil diperbarui.');
    }

    public function destroy(Game $game)
    {
        if ($game->image) {
            Storage::disk('public')->delete($game->image);
        }
        $game->delete();

        return to_route('admin.games.index')->with('success', 'Game berhasil dihapus.');
    }

    private function validated(Request $request, ?Game $game = null): array
    {
        if (! $request->filled('slug')) {
            $request->merge(['slug' => Str::slug((string) $request->input('title'))]);
        }
        $data = $request->validate([
            'console_id' => ['required', 'exists:consoles,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', Rule::unique('games')->ignore($game?->id)],
            'genre' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}
