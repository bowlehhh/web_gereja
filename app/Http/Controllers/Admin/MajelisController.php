<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MajelisPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MajelisController extends Controller
{
    public function index()
    {
        $periodItems = collect();
        $editPeriod = null;
        $periodTableReady = Schema::hasTable('majelis_periods');
        if ($periodTableReady) {
            $periodItems = MajelisPeriod::query()
                ->orderByDesc('updated_at')
                ->orderByDesc('id')
                ->get();

            $editId = request()->query('edit_period');
            if (!empty($editId)) {
                $editPeriod = MajelisPeriod::query()->findOrFail($editId);
            }
        }

        return view('admin.majelis.index', [
            'period_items' => $periodItems,
            'edit_period' => $editPeriod,
            'period_table_ready' => $periodTableReady,
            'table_ready' => true,
        ]);
    }

    public function storePeriod(Request $request)
    {
        abort_unless(Schema::hasTable('majelis_periods'), 404);

        $data = $request->validate([
            'period' => ['required', 'string', 'max:120', 'unique:majelis_periods,period'],
            'about' => ['nullable', 'string'],
            'service' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
            'gallery' => ['nullable', 'array', 'max:20'],
            'gallery.*' => ['file', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
        ], [
            'period.required' => 'Periode wajib diisi.',
            'period.unique' => 'Periode ini sudah ada.',
            'thumbnail.mimes' => 'Thumbnail harus JPG/JPEG/PNG/WEBP.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 20MB.',
            'gallery.max' => 'Maksimal 20 foto gallery.',
            'gallery.*.mimes' => 'Foto gallery harus JPG/JPEG/PNG/WEBP.',
            'gallery.*.max' => 'Ukuran foto gallery maksimal 20MB.',
        ]);

        $slug = Str::slug($data['period']);

        $thumbPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbPath = $request->file('thumbnail')->store("majelis/periods/{$slug}", 'public');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store("majelis/periods/{$slug}/gallery", 'public');
            }
        }

        MajelisPeriod::create([
            'period' => $data['period'],
            'thumbnail_path' => $thumbPath,
            'gallery_paths' => $galleryPaths ?: null,
            'about' => $data['about'] ?? null,
            'service' => $data['service'] ?? null,
        ]);

        return redirect()
            ->route('admin.majelis.index')
            ->with('ok', 'Periode majelis berhasil ditambahkan.');
    }

    public function updatePeriod(Request $request, MajelisPeriod $majelisPeriod)
    {
        abort_unless(Schema::hasTable('majelis_periods'), 404);

        $data = $request->validate([
            'period' => ['required', 'string', 'max:120', 'unique:majelis_periods,period,'.$majelisPeriod->id],
            'about' => ['nullable', 'string'],
            'service' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
            'gallery' => ['nullable', 'array', 'max:20'],
            'gallery.*' => ['file', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
            'clear_gallery' => ['nullable'],
        ], [
            'period.required' => 'Periode wajib diisi.',
            'period.unique' => 'Periode ini sudah ada.',
            'thumbnail.mimes' => 'Thumbnail harus JPG/JPEG/PNG/WEBP.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 20MB.',
            'gallery.max' => 'Maksimal 20 foto gallery.',
            'gallery.*.mimes' => 'Foto gallery harus JPG/JPEG/PNG/WEBP.',
            'gallery.*.max' => 'Ukuran foto gallery maksimal 20MB.',
        ]);

        $slug = Str::slug($data['period']);

        if ($request->hasFile('thumbnail')) {
            if ($majelisPeriod->thumbnail_path && Storage::disk('public')->exists($majelisPeriod->thumbnail_path)) {
                Storage::disk('public')->delete($majelisPeriod->thumbnail_path);
            }
            $majelisPeriod->thumbnail_path = $request->file('thumbnail')->store("majelis/periods/{$slug}", 'public');
        }

        if ($request->boolean('clear_gallery')) {
            foreach (($majelisPeriod->gallery_paths ?? []) as $old) {
                if ($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
            }
            $majelisPeriod->gallery_paths = null;
        }

        if ($request->hasFile('gallery')) {
            foreach (($majelisPeriod->gallery_paths ?? []) as $old) {
                if ($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
            }

            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store("majelis/periods/{$slug}/gallery", 'public');
            }
            $majelisPeriod->gallery_paths = $galleryPaths ?: null;
        }

        $majelisPeriod->period = $data['period'];
        $majelisPeriod->about = $data['about'] ?? null;
        $majelisPeriod->service = $data['service'] ?? null;
        $majelisPeriod->save();

        return redirect()
            ->route('admin.majelis.index')
            ->with('ok', 'Periode majelis berhasil diupdate.');
    }

    public function destroyPeriod(MajelisPeriod $majelisPeriod)
    {
        abort_unless(Schema::hasTable('majelis_periods'), 404);

        if ($majelisPeriod->thumbnail_path && Storage::disk('public')->exists($majelisPeriod->thumbnail_path)) {
            Storage::disk('public')->delete($majelisPeriod->thumbnail_path);
        }

        foreach (($majelisPeriod->gallery_paths ?? []) as $old) {
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
        }

        $majelisPeriod->delete();

        return redirect()
            ->route('admin.majelis.index')
            ->with('ok', 'Periode majelis berhasil dihapus.');
    }
}
