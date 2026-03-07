<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HambaTuhan;
use App\Support\ImageUpload;
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
            'photo' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
            'roles_summary' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:120'],
            'profile' => ['required', 'string'],
            'service_fields' => ['required', 'string'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:1000000'],
            'is_active' => ['nullable'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'photo.required' => 'Foto wajib diupload.',
            'photo.mimes' => 'Foto harus JPG/JPEG/PNG/WEBP.',
            'photo.max' => 'Ukuran foto maksimal 20MB.',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = ImageUpload::storeAsWebp($request->file('photo'), 'hamba_tuhan/photos');
        }

        $item = HambaTuhan::create([
            'name' => $data['name'],
            'slug' => HambaTuhan::uniqueSlug($data['name']),
            'photo_path' => $photoPath,
            'roles_summary' => $data['roles_summary'],
            'contact' => $data['contact'],
            'profile' => $data['profile'],
            'service_fields' => $data['service_fields'],
            'sort_order' => $data['sort_order'],
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
            'photo' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
            'roles_summary' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:120'],
            'profile' => ['required', 'string'],
            'service_fields' => ['required', 'string'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:1000000'],
            'is_active' => ['nullable'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'photo.required' => 'Foto wajib diupload.',
            'photo.mimes' => 'Foto harus JPG/JPEG/PNG/WEBP.',
            'photo.max' => 'Ukuran foto maksimal 20MB.',
        ]);

        if ($request->hasFile('photo')) {
            if ($hambaTuhan->photo_path && Storage::disk('public')->exists($hambaTuhan->photo_path)) {
                Storage::disk('public')->delete($hambaTuhan->photo_path);
            }
            $hambaTuhan->photo_path = ImageUpload::storeAsWebp($request->file('photo'), 'hamba_tuhan/photos');
        }

        $hambaTuhan->name = $data['name'];
        $hambaTuhan->slug = HambaTuhan::uniqueSlug($data['name'], $hambaTuhan->id);
        $hambaTuhan->roles_summary = $data['roles_summary'];
        $hambaTuhan->contact = $data['contact'];
        $hambaTuhan->profile = $data['profile'];
        $hambaTuhan->service_fields = $data['service_fields'];
        $hambaTuhan->sort_order = $data['sort_order'];
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
