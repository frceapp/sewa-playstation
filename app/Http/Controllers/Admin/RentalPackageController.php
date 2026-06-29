<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Models\RentalPackage;
use Illuminate\Http\Request;

class RentalPackageController extends Controller
{
    public function index()
    {
        return view('admin.packages.index', ['packages' => RentalPackage::with('console')->latest()->paginate(15)]);
    }

    public function create()
    {
        return view('admin.packages.create', ['package' => new RentalPackage, 'consoles' => Console::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        RentalPackage::create($this->validated($request));

        return to_route('admin.packages.index')->with('success', 'Paket sewa berhasil ditambahkan.');
    }

    public function edit(RentalPackage $package)
    {
        return view('admin.packages.edit', ['package' => $package, 'consoles' => Console::orderBy('name')->get()]);
    }

    public function update(Request $request, RentalPackage $package)
    {
        $package->update($this->validated($request));

        return to_route('admin.packages.index')->with('success', 'Paket sewa berhasil diperbarui.');
    }

    public function destroy(RentalPackage $package)
    {
        $package->delete();

        return to_route('admin.packages.index')->with('success', 'Paket sewa berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'console_id' => ['required', 'exists:consoles,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'features' => ['nullable', 'array'],
            'features.*' => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $features = collect($data['features'] ?? [])
            ->map(fn ($feature) => trim((string) $feature))
            ->filter()
            ->values()
            ->all();

        $data['features'] = $features === [] ? null : json_encode($features, JSON_UNESCAPED_UNICODE);
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}
