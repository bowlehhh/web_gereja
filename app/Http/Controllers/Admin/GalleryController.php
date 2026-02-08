<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        // ✅ HARUS paginate supaya bisa ->links()
        $items = GalleryItem::query()
            ->latest('id')
            ->paginate(12);

        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'caption' => ['nullable', 'string'],
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_published' => ['nullable'],
        ], [
            'photo.required' => 'Foto wajib diupload.',
            'photo.mimes' => 'Foto harus jpg/jpeg/png/webp.',
            'photo.max' => 'Ukuran foto maksimal 5MB.',
        ]);

        $path = $request->file('photo')->store('gallery', 'public');

        GalleryItem::create([
            'title' => $data['title'],
            'caption' => $data['caption'] ?? null,
            'image_path' => $path,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.gallery.index')->with('ok', 'Foto berhasil ditambahkan.');
    }

    public function edit(GalleryItem $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'caption' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_published' => ['nullable'],
        ]);

        if ($request->hasFile('photo')) {
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $gallery->image_path = $request->file('photo')->store('gallery', 'public');
        }

        $gallery->title = $data['title'];
        $gallery->caption = $data['caption'] ?? null;
        $gallery->is_published = $request->boolean('is_published');
        $gallery->save();

        return redirect()->route('admin.gallery.index')->with('ok', 'Foto berhasil diupdate.');
    }

    public function destroy(GalleryItem $gallery)
    {
        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('ok', 'Foto berhasil dihapus.');
    }
}
