<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Console;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ConsoleController extends Controller
{
    public function index()
    {
        return view('admin.consoles.index', [
            'consoles' => Console::withCount(['games', 'rentalPackages'])->orderBy('name')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.consoles.create', ['console' => new Console]);
    }

    public function store(Request $request)
    {
        Console::create($this->validated($request));

        return to_route('admin.consoles.index')->with('success', 'Konsol berhasil ditambahkan.');
    }

    public function edit(Console $console)
    {
        return view('admin.consoles.edit', compact('console'));
    }

    public function update(Request $request, Console $console)
    {
        $console->update($this->validated($request, $console));

        return to_route('admin.consoles.index')->with('success', 'Konsol berhasil diperbarui.');
    }

    public function destroy(Console $console)
    {
        if ($console->games()->exists() || $console->rentalPackages()->exists()) {
            return back()->with('error', 'Konsol masih digunakan oleh game atau paket sewa.');
        }

        $console->delete();

        return to_route('admin.consoles.index')->with('success', 'Konsol berhasil dihapus.');
    }

    private function validated(Request $request, ?Console $console = null): array
    {
        if (! $request->filled('slug')) {
            $request->merge(['slug' => Str::slug((string) $request->input('name'))]);
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', Rule::unique('consoles')->ignore($console?->id)],
            'description' => ['nullable', 'string'],
        ]);
    }
}
