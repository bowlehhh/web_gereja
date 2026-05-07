<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Support\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class CabangController extends Controller
{
    public function index()
    {
        $items = Cabang::query()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(12);

        return view('admin.cabang.index', compact('items'));
    }

    public function create()
    {
        return view('admin.cabang.create');
    }

    public function store(Request $request)
    {
        $this->normalizeMapCoordinateInputs($request);

        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:160'],
            'city' => ['nullable', 'string', 'max:140'],
            'address' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:60'],
            'pastor' => ['nullable', 'string', 'max:160'],
            'map_latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'map_longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'about' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'is_published' => ['nullable'],
        ], [
            'photo.required' => 'Foto cabang wajib diupload.',
            'photo.mimes' => 'Foto harus jpg/jpeg/png/webp.',
            'photo.max' => 'Ukuran foto maksimal 20MB.',
            'map_latitude.between' => 'Latitude harus di rentang -90 sampai 90.',
            'map_longitude.between' => 'Longitude harus di rentang -180 sampai 180.',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $path = ImageUpload::storeAsWebp($request->file('photo'), 'cabang');
        }

        $payload = [
            'name' => $data['name'] ?? null,
            'city' => $data['city'] ?? null,
            'about' => $data['about'] ?? null,
            'image_path' => $path,
            'sort_order' => (int) ($data['sort_order'] ?? 0),
            'is_published' => $request->boolean('is_published'),
        ];

        foreach ($this->cabangOptionalColumns() as $column => $exists) {
            if ($exists) {
                $payload[$column] = $data[$column] ?? null;
            }
        }

        Cabang::create($payload);

        return redirect()->route('admin.cabang.index')->with('ok', 'Cabang berhasil ditambahkan.');
    }

    public function edit(Cabang $cabang)
    {
        return view('admin.cabang.edit', compact('cabang'));
    }

    public function update(Request $request, Cabang $cabang)
    {
        $this->normalizeMapCoordinateInputs($request);

        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:160'],
            'city' => ['nullable', 'string', 'max:140'],
            'address' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:60'],
            'pastor' => ['nullable', 'string', 'max:160'],
            'map_latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'map_longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'about' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'is_published' => ['nullable'],
        ], [
            'photo.required' => 'Foto cabang wajib diupload.',
            'photo.mimes' => 'Foto harus jpg/jpeg/png/webp.',
            'photo.max' => 'Ukuran foto maksimal 20MB.',
            'map_latitude.between' => 'Latitude harus di rentang -90 sampai 90.',
            'map_longitude.between' => 'Longitude harus di rentang -180 sampai 180.',
        ]);

        if ($request->hasFile('photo')) {
            if ($cabang->image_path && Storage::disk('public')->exists($cabang->image_path)) {
                Storage::disk('public')->delete($cabang->image_path);
            }
            $cabang->image_path = ImageUpload::storeAsWebp($request->file('photo'), 'cabang');
        }

        $cabang->name = $data['name'] ?? null;
        $cabang->city = $data['city'] ?? null;
        foreach ($this->cabangOptionalColumns() as $column => $exists) {
            if ($exists) {
                $cabang->{$column} = $data[$column] ?? null;
            }
        }
        $cabang->about = $data['about'] ?? null;
        $cabang->sort_order = (int) ($data['sort_order'] ?? 0);
        $cabang->is_published = $request->boolean('is_published');
        $cabang->save();

        return redirect()->route('admin.cabang.edit', $cabang)->with('ok', 'Cabang berhasil diupdate.');
    }

    public function destroy(Cabang $cabang)
    {
        if ($cabang->image_path && Storage::disk('public')->exists($cabang->image_path)) {
            Storage::disk('public')->delete($cabang->image_path);
        }

        $cabang->delete();

        return redirect()->route('admin.cabang.index')->with('ok', 'Cabang berhasil dihapus.');
    }

    /**
     * Keep create/update compatible when older DB schema has not received
     * the cabang detail-field migration yet.
     *
     * @return array<string, bool>
     */
    private function cabangOptionalColumns(): array
    {
        static $cache = null;

        if ($cache !== null) {
            return $cache;
        }

        $columns = ['address', 'email', 'phone', 'pastor', 'map_latitude', 'map_longitude'];
        $cache = [];

        foreach ($columns as $column) {
            $cache[$column] = Schema::hasColumn('cabangs', $column);
        }

        return $cache;
    }

    private function normalizeMapCoordinateInputs(Request $request): void
    {
        foreach (['map_latitude', 'map_longitude'] as $field) {
            $value = $request->input($field);

            if (!is_string($value)) {
                continue;
            }

            $normalized = trim($value);
            if ($normalized === '') {
                $request->merge([$field => null]);
                continue;
            }

            // Accept Indonesian decimal input using comma, e.g. -0,5021836
            $request->merge([$field => str_replace(',', '.', $normalized)]);
        }
    }
}
