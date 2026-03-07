<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RenunganItem;
use App\Support\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class RenunganController extends Controller
{
    public function index()
    {
        $migrationMissing = false;
        $items = collect();

        try {
            if (Schema::hasTable('renungan_items')) {
                $items = RenunganItem::query()
                    ->orderBy('sort_order')
                    ->orderByDesc('published_at')
                    ->orderByDesc('id')
                    ->paginate(12);
            } else {
                $migrationMissing = true;
            }
        } catch (\Throwable $e) {
            $migrationMissing = true;
            $items = collect();
        }

        return view('admin.renungan.index', compact('items', 'migrationMissing'));
    }

    public function create()
    {
        return view('admin.renungan.create');
    }

    public function store(Request $request)
    {
        if (!Schema::hasTable('renungan_items')) {
            return back()
                ->withInput()
                ->withErrors(['database' => 'Tabel renungan belum tersedia. Jalankan php artisan migrate terlebih dahulu.']);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'scripture_reference' => ['required', 'string', 'max:180'],
            'author' => ['required', 'string', 'max:120'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
            'published_at' => ['required', 'date'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:1000000'],
            'is_published' => ['nullable'],
        ], [
            'title.required' => 'Judul renungan wajib diisi.',
            'scripture_reference.required' => 'Ayat renungan wajib diisi.',
            'author.required' => 'Nama penulis/pembawa wajib diisi.',
            'excerpt.required' => 'Ayat firman wajib diisi.',
            'content.required' => 'Tafsiran renungan wajib diisi.',
            'image.required' => 'Gambar renungan wajib diupload.',
            'image.mimes' => 'Gambar renungan harus JPG/JPEG/PNG/WEBP.',
            'image.max' => 'Ukuran gambar renungan maksimal 20MB.',
            'published_at.required' => 'Tanggal tayang renungan wajib diisi.',
        ]);

        $path = ImageUpload::storeAsWebp($request->file('image'), 'renungan');

        RenunganItem::create([
            'title' => $data['title'],
            'slug' => RenunganItem::uniqueSlug($data['title']),
            'scripture_reference' => $data['scripture_reference'],
            'author' => $data['author'],
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'image_path' => $path,
            'published_at' => $data['published_at'],
            'sort_order' => $data['sort_order'],
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.renungan.index')->with('ok', 'Renungan berhasil ditambahkan.');
    }

    public function edit(RenunganItem $renunganItem)
    {
        return view('admin.renungan.edit', [
            'item' => $renunganItem,
        ]);
    }

    public function update(Request $request, RenunganItem $renunganItem)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'scripture_reference' => ['required', 'string', 'max:180'],
            'author' => ['required', 'string', 'max:120'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
            'published_at' => ['required', 'date'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:1000000'],
            'is_published' => ['nullable'],
        ], [
            'title.required' => 'Judul renungan wajib diisi.',
            'scripture_reference.required' => 'Ayat renungan wajib diisi.',
            'author.required' => 'Nama penulis/pembawa wajib diisi.',
            'excerpt.required' => 'Ayat firman wajib diisi.',
            'content.required' => 'Tafsiran renungan wajib diisi.',
            'image.required' => 'Gambar renungan wajib diupload.',
            'image.mimes' => 'Gambar renungan harus JPG/JPEG/PNG/WEBP.',
            'image.max' => 'Ukuran gambar renungan maksimal 20MB.',
            'published_at.required' => 'Tanggal tayang renungan wajib diisi.',
        ]);

        if ($request->hasFile('image')) {
            if ($renunganItem->image_path && Storage::disk('public')->exists($renunganItem->image_path)) {
                Storage::disk('public')->delete($renunganItem->image_path);
            }
            $renunganItem->image_path = ImageUpload::storeAsWebp($request->file('image'), 'renungan');
        }

        $renunganItem->title = $data['title'];
        $renunganItem->slug = RenunganItem::uniqueSlug($data['title'], $renunganItem->id);
        $renunganItem->scripture_reference = $data['scripture_reference'];
        $renunganItem->author = $data['author'];
        $renunganItem->excerpt = $data['excerpt'];
        $renunganItem->content = $data['content'];
        $renunganItem->published_at = $data['published_at'];
        $renunganItem->sort_order = $data['sort_order'];
        $renunganItem->is_published = $request->boolean('is_published');
        $renunganItem->save();

        return redirect()->route('admin.renungan.index')->with('ok', 'Renungan berhasil diupdate.');
    }

    public function destroy(RenunganItem $renunganItem)
    {
        if ($renunganItem->image_path && Storage::disk('public')->exists($renunganItem->image_path)) {
            Storage::disk('public')->delete($renunganItem->image_path);
        }

        $renunganItem->delete();

        return redirect()->route('admin.renungan.index')->with('ok', 'Renungan berhasil dihapus.');
    }
}
