<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WartaController extends Controller
{
    public function index()
    {
        $wartas = Warta::query()
            ->latest('date')
            ->latest('id')
            ->paginate(10);

        return view('admin.warta.index', compact('wartas'));
    }

    public function create()
    {
        return view('admin.warta.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'date' => ['nullable', 'date'],
            'edition' => ['nullable', 'string', 'max:50'],

            // thumbnail optional
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:20480'],

            // pdf wajib
            'pdf' => ['required', 'file', 'mimes:pdf', 'max:20480'],

            'is_published' => ['nullable'],
        ], [
            'title.required' => 'Judul wajib diisi.',
            'date.date' => 'Format tanggal tidak valid.',
            'thumbnail.mimes' => 'Thumbnail harus JPG/JPEG/PNG/WEBP.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 20MB.',
            'pdf.required' => 'PDF Warta wajib diupload.',
            'pdf.mimes' => 'File warta harus PDF.',
            'pdf.max' => 'Ukuran PDF maksimal 20MB.',
        ]);

        $thumbPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbPath = $request->file('thumbnail')->store('warta/thumbs', 'public');
        }

        $pdfPath = $request->file('pdf')->store('warta/pdfs', 'public');

        Warta::create([
            'title' => $data['title'],
            'date' => $data['date'] ?? null,
            'edition' => $data['edition'] ?? null,
            'thumbnail_path' => $thumbPath,
            'pdf_path' => $pdfPath,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.warta.index')->with('ok', 'Warta berhasil ditambahkan.');
    }

    public function edit(Warta $warta)
    {
        return view('admin.warta.edit', compact('warta'));
    }

    public function update(Request $request, Warta $warta)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'date' => ['nullable', 'date'],
            'edition' => ['nullable', 'string', 'max:50'],
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
            'pdf' => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
            'is_published' => ['nullable'],
        ], [
            'title.required' => 'Judul wajib diisi.',
            'date.date' => 'Format tanggal tidak valid.',
            'thumbnail.mimes' => 'Thumbnail harus JPG/JPEG/PNG/WEBP.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 20MB.',
            'pdf.mimes' => 'File warta harus PDF.',
            'pdf.max' => 'Ukuran PDF maksimal 20MB.',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($warta->thumbnail_path && Storage::disk('public')->exists($warta->thumbnail_path)) {
                Storage::disk('public')->delete($warta->thumbnail_path);
            }
            $warta->thumbnail_path = $request->file('thumbnail')->store('warta/thumbs', 'public');
        }

        if ($request->hasFile('pdf')) {
            if ($warta->pdf_path && Storage::disk('public')->exists($warta->pdf_path)) {
                Storage::disk('public')->delete($warta->pdf_path);
            }
            $warta->pdf_path = $request->file('pdf')->store('warta/pdfs', 'public');
        }

        $warta->title = $data['title'];
        $warta->date = $data['date'] ?? null;
        $warta->edition = $data['edition'] ?? null;
        $warta->is_published = $request->boolean('is_published');
        $warta->save();

        return redirect()->route('admin.warta.index')->with('ok', 'Warta berhasil diupdate.');
    }

    public function destroy(Warta $warta)
    {
        if ($warta->thumbnail_path && Storage::disk('public')->exists($warta->thumbnail_path)) {
            Storage::disk('public')->delete($warta->thumbnail_path);
        }

        if ($warta->pdf_path && Storage::disk('public')->exists($warta->pdf_path)) {
            Storage::disk('public')->delete($warta->pdf_path);
        }

        $warta->delete();

        return redirect()->route('admin.warta.index')->with('ok', 'Warta berhasil dihapus.');
    }
}
