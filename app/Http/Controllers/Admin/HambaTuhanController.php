<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HambaTuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class HambaTuhanController extends Controller
{
    public function index()
    {
        if (!Schema::hasTable('hamba_tuhans')) {
            return view('admin.hamba.index', [
                'items' => collect(),
                'table_ready' => false,
            ]);
        }

        $items = HambaTuhan::query()
            ->latest('updated_at')
            ->latest('id')
            ->paginate(12);

        return view('admin.hamba.index', [
            'items' => $items,
            'table_ready' => true,
        ]);
    }

    public function create()
    {
        return view('admin.hamba.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'roles_summary' => ['nullable', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:120'],
            'profile' => ['nullable', 'string'],
            'service_fields' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:1000000'],
            'is_active' => ['nullable'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'photo.mimes' => 'Foto harus JPG/JPEG/PNG/WEBP.',
            'photo.max' => 'Ukuran foto maksimal 5MB.',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('hamba_tuhan/photos', 'public');
        }

        $item = HambaTuhan::create([
            'name' => $data['name'],
            'slug' => HambaTuhan::uniqueSlug($data['name']),
            'photo_path' => $photoPath,
            'roles_summary' => $data['roles_summary'] ?? null,
            'contact' => $data['contact'] ?? null,
            'profile' => $data['profile'] ?? null,
            'service_fields' => $data['service_fields'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.hamba.edit', $item)->with('ok', 'Hamba Tuhan berhasil ditambahkan.');
    }

    public function edit(HambaTuhan $hambaTuhan)
    {
        abort_unless(Schema::hasTable('hamba_tuhans'), 404);
        return view('admin.hamba.edit', [
            'item' => $hambaTuhan,
        ]);
    }

    public function update(Request $request, HambaTuhan $hambaTuhan)
    {
        abort_unless(Schema::hasTable('hamba_tuhans'), 404);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'roles_summary' => ['nullable', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:120'],
            'profile' => ['nullable', 'string'],
            'service_fields' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:1000000'],
            'is_active' => ['nullable'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'photo.mimes' => 'Foto harus JPG/JPEG/PNG/WEBP.',
            'photo.max' => 'Ukuran foto maksimal 5MB.',
        ]);

        if ($request->hasFile('photo')) {
            if ($hambaTuhan->photo_path && Storage::disk('public')->exists($hambaTuhan->photo_path)) {
                Storage::disk('public')->delete($hambaTuhan->photo_path);
            }
            $hambaTuhan->photo_path = $request->file('photo')->store('hamba_tuhan/photos', 'public');
        }

        $hambaTuhan->name = $data['name'];
        $hambaTuhan->slug = HambaTuhan::uniqueSlug($data['name'], $hambaTuhan->id);
        $hambaTuhan->roles_summary = $data['roles_summary'] ?? null;
        $hambaTuhan->contact = $data['contact'] ?? null;
        $hambaTuhan->profile = $data['profile'] ?? null;
        $hambaTuhan->service_fields = $data['service_fields'] ?? null;
        $hambaTuhan->sort_order = $data['sort_order'] ?? 0;
        $hambaTuhan->is_active = $request->boolean('is_active');
        $hambaTuhan->save();

        return redirect()->route('admin.hamba.edit', $hambaTuhan)->with('ok', 'Hamba Tuhan berhasil diupdate.');
    }

    public function destroy(HambaTuhan $hambaTuhan)
    {
        abort_unless(Schema::hasTable('hamba_tuhans'), 404);
        if ($hambaTuhan->photo_path && Storage::disk('public')->exists($hambaTuhan->photo_path)) {
            Storage::disk('public')->delete($hambaTuhan->photo_path);
        }

        $hambaTuhan->delete();

        return redirect()->route('admin.hamba.index')->with('ok', 'Hamba Tuhan berhasil dihapus.');
    }
}
