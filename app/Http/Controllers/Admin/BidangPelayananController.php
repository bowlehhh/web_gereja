<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BidangPelayanan;
use App\Support\ImageUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class BidangPelayananController extends Controller
{
    private const MAX_FILE_SIZE_KB = 12288;

    public function index()
    {
        if (!Schema::hasTable('bidang_pelayanans')) {
            return view('admin.bidang.index', [
                'items' => collect(),
                'table_ready' => false,
            ]);
        }

        $items = BidangPelayanan::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12);

        return view('admin.bidang.index', [
            'items' => $items,
            'table_ready' => true,
        ]);
    }

    public function create()
    {
        return view('admin.bidang.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages());
        $uploadedFile = $request->file('member_photo');
        $storedPhoto = null;

        try {
            if ($uploadedFile instanceof UploadedFile) {
                $storedPhoto = $this->storeMemberPhoto($uploadedFile);
            }

            $item = BidangPelayanan::create([
                'name' => $data['name'],
                'slug' => BidangPelayanan::uniqueSlug(trim((string) (($data['slug'] ?? '') !== '' ? $data['slug'] : $data['name']))),
                'description' => $data['description'],
                'service_year' => (int) $data['service_year'],
                'member_photo_paths' => $storedPhoto !== null ? [$storedPhoto] : [],
                'sort_order' => (int) $data['sort_order'],
                'is_active' => $request->boolean('is_active'),
            ]);
        } catch (\Throwable $e) {
            $this->deletePhotos(array_filter([$storedPhoto]));
            throw $e;
        }

        return redirect()->route('admin.bidang.edit', $item)->with('ok', 'Bidang pelayanan berhasil ditambahkan.');
    }

    public function edit(BidangPelayanan $bidangPelayanan)
    {
        abort_unless(Schema::hasTable('bidang_pelayanans'), 404);

        return view('admin.bidang.edit', [
            'item' => $bidangPelayanan,
        ]);
    }

    public function update(Request $request, BidangPelayanan $bidangPelayanan)
    {
        abort_unless(Schema::hasTable('bidang_pelayanans'), 404);

        $data = $request->validate($this->rules(true), $this->messages());

        $existingPhotos = $this->normalizePhotoPaths($bidangPelayanan->member_photo_paths ?? []);
        $existingPhoto = $existingPhotos[0] ?? null;
        $uploadedFile = $request->file('member_photo');
        $removeExistingPhoto = $request->boolean('remove_member_photo');
        $storedPhoto = null;
        $nextPhotos = [];

        try {
            if ($uploadedFile instanceof UploadedFile) {
                $storedPhoto = $this->storeMemberPhoto($uploadedFile);
                $nextPhotos = [$storedPhoto];
            } elseif (!$removeExistingPhoto && $existingPhoto !== null) {
                $nextPhotos = [$existingPhoto];
            }

            $bidangPelayanan->fill([
                'name' => $data['name'],
                'slug' => BidangPelayanan::uniqueSlug(trim((string) (($data['slug'] ?? '') !== '' ? $data['slug'] : $data['name'])), $bidangPelayanan->id),
                'description' => $data['description'],
                'service_year' => (int) $data['service_year'],
                'member_photo_paths' => $nextPhotos,
                'sort_order' => (int) $data['sort_order'],
                'is_active' => $request->boolean('is_active'),
            ]);
            $bidangPelayanan->save();
        } catch (\Throwable $e) {
            $this->deletePhotos(array_filter([$storedPhoto]));
            throw $e;
        }

        $this->deletePhotos(array_values(array_diff($existingPhotos, $nextPhotos)));

        return redirect()->route('admin.bidang.edit', $bidangPelayanan)->with('ok', 'Bidang pelayanan berhasil diupdate.');
    }

    public function destroy(BidangPelayanan $bidangPelayanan)
    {
        abort_unless(Schema::hasTable('bidang_pelayanans'), 404);

        $this->deletePhotos($this->normalizePhotoPaths($bidangPelayanan->member_photo_paths ?? []));
        $bidangPelayanan->delete();

        return redirect()->route('admin.bidang.index')->with('ok', 'Bidang pelayanan berhasil dihapus.');
    }

    private function rules(bool $updating = false): array
    {
        return [
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'description' => ['required', 'string'],
            'service_year' => ['required', 'integer', 'min:2000', 'max:2100'],
            'member_photo' => [$updating ? 'nullable' : 'required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:'.self::MAX_FILE_SIZE_KB],
            'remove_member_photo' => ['nullable'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:1000000'],
            'is_active' => ['nullable'],
        ];
    }

    private function messages(): array
    {
        return [
            'name.required' => 'Nama bidang wajib diisi.',
            'slug.regex' => 'Slug hanya boleh huruf kecil, angka, dan tanda minus.',
            'description.required' => 'Deskripsi bidang wajib diisi.',
            'service_year.required' => 'Tahun bidang wajib diisi.',
            'service_year.integer' => 'Tahun bidang harus berupa angka.',
            'service_year.min' => 'Tahun bidang minimal 2000.',
            'service_year.max' => 'Tahun bidang maksimal 2100.',
            'member_photo.required' => 'Foto bidang pelayanan wajib diupload.',
            'member_photo.mimes' => 'Foto bidang harus berformat JPG, JPEG, PNG, atau WEBP.',
            'member_photo.max' => 'Ukuran foto maksimal 12 MB.',
            'sort_order.required' => 'Urutan tampil wajib diisi.',
        ];
    }

    private function storeMemberPhoto(UploadedFile $file): string
    {
        return ImageUpload::storeAsWebp(
            $file,
            'bidang-pelayanan/members',
            'public',
            82,
            960,
            960
        );
    }

    /**
     * @param  array<int, string>  $paths
     */
    private function deletePhotos(array $paths): void
    {
        foreach ($paths as $path) {
            if ($path !== '' && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }

    /**
     * @param  mixed  $paths
     * @return array<int, string>
     */
    private function normalizePhotoPaths(mixed $paths): array
    {
        if (!is_array($paths)) {
            return [];
        }

        return array_values(array_filter(array_map(function ($path) {
            return is_string($path) ? trim($path) : '';
        }, $paths)));
    }
}
