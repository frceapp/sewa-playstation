<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index', ['pages' => Page::orderBy('sort_order')->orderBy('title')->paginate(15)]);
    }

    public function create()
    {
        return view('admin.pages.create', ['page' => new Page]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['image'] = $request->file('image')?->store('pages', 'public');

        Page::create($data);

        return to_route('admin.pages.index')->with('success', 'Halaman berhasil ditambahkan.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $this->validated($request, $page);

        if ($request->hasFile('image')) {
            if ($page->image) {
                Storage::disk('public')->delete($page->image);
            }
            $data['image'] = $request->file('image')->store('pages', 'public');
        }

        if ($request->boolean('remove_image')) {
            if ($page->image) {
                Storage::disk('public')->delete($page->image);
            }
            $data['image'] = null;
        }

        $page->update($data);

        return to_route('admin.pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(Page $page)
    {
        if ($page->image) {
            Storage::disk('public')->delete($page->image);
        }
        $page->delete();

        return to_route('admin.pages.index')->with('success', 'Halaman berhasil dihapus.');
    }

    private function validated(Request $request, ?Page $page = null): array
    {
        if (! $request->filled('slug')) {
            $request->merge(['slug' => Str::slug((string) $request->input('title'))]);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', Rule::unique('pages')->ignore($page?->id)],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'show_in_navigation' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['show_in_navigation'] = $request->boolean('show_in_navigation');
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}
