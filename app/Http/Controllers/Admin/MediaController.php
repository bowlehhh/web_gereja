<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use App\Support\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $items = MediaItem::query()
            ->orderByRaw('COALESCE(service_at, created_at) DESC')
            ->orderByDesc('id')
            ->paginate(12);

        return view('admin.media.index', compact('items'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => ['nullable', 'string', 'max:200'],
                'speaker' => ['nullable', 'string', 'max:150'],
                'service_at' => ['nullable', 'date'],
                'youtube_url' => [
                    'nullable',
                    'string',
                    'max:255',
                    function (string $attribute, mixed $value, \Closure $fail) {
                        if ($value === null || $value === '') {
                            return;
                        }

                        if (!is_string($value) || !MediaItem::extractYoutubeId($value)) {
                            $fail('Link YouTube tidak valid.');
                        }
                    },
                ],
                'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
                'is_published' => ['nullable'],
            ],
            [
                'thumbnail.required' => 'Thumbnail wajib diupload.',
                'thumbnail.max' => 'Ukuran thumbnail maksimal 10MB.',
            ],
            [
                'title' => 'Judul',
                'speaker' => 'Pembicara',
                'service_at' => 'Tanggal & Jam',
                'youtube_url' => 'YouTube URL',
                'thumbnail' => 'Thumbnail',
            ]
        );

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = ImageUpload::storeAsWebp($request->file('thumbnail'), 'media/thumbnails');
        }

        $youtubeUrl = trim((string) ($data['youtube_url'] ?? ''));
        $youtubeUrl = $youtubeUrl !== '' ? $youtubeUrl : null;
        $youtubeId = MediaItem::extractYoutubeId($youtubeUrl);

        MediaItem::create([
            'title' => $data['title'] ?? null,
            'speaker' => $data['speaker'] ?? null,
            'service_at' => $data['service_at'] ?? null,
            'youtube_url' => $youtubeUrl,
            'youtube_id' => $youtubeId,
            'thumbnail_path' => $thumbnailPath,
            'is_published' => $request->has('is_published') ? $request->boolean('is_published') : true,
        ]);

        return redirect()->route('admin.media.index')->with('ok', 'Media berhasil ditambahkan.');
    }

    public function edit(MediaItem $media)
    {
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, MediaItem $media)
    {
        $data = $request->validate(
            [
                'title' => ['nullable', 'string', 'max:200'],
                'speaker' => ['nullable', 'string', 'max:150'],
                'service_at' => ['nullable', 'date'],
                'youtube_url' => [
                    'nullable',
                    'string',
                    'max:255',
                    function (string $attribute, mixed $value, \Closure $fail) {
                        if ($value === null || $value === '') {
                            return;
                        }

                        if (!is_string($value) || !MediaItem::extractYoutubeId($value)) {
                            $fail('Link YouTube tidak valid.');
                        }
                    },
                ],
                'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
                'is_published' => ['nullable'],
            ],
            [
                'thumbnail.max' => 'Ukuran thumbnail maksimal 10MB.',
            ]
        );

        $media->title = $data['title'] ?? null;
        $media->speaker = $data['speaker'] ?? null;
        $media->service_at = $data['service_at'] ?? null;
        $youtubeUrl = trim((string) ($data['youtube_url'] ?? ''));
        $youtubeUrl = $youtubeUrl !== '' ? $youtubeUrl : null;
        $media->youtube_url = $youtubeUrl;
        $media->youtube_id = MediaItem::extractYoutubeId($youtubeUrl);
        $media->is_published = $request->boolean('is_published');

        if ($request->hasFile('thumbnail')) {
            if (!empty($media->thumbnail_path)) {
                Storage::disk('public')->delete($media->thumbnail_path);
            }
            $media->thumbnail_path = ImageUpload::storeAsWebp($request->file('thumbnail'), 'media/thumbnails');
        }

        $media->save();

        return redirect()->route('admin.media.index')->with('ok', 'Media berhasil diupdate.');
    }

    public function destroy(MediaItem $media)
    {
        if (!empty($media->thumbnail_path)) {
            Storage::disk('public')->delete($media->thumbnail_path);
        }
        $media->delete();

        return redirect()->route('admin.media.index')->with('ok', 'Media berhasil dihapus.');
    }
}
