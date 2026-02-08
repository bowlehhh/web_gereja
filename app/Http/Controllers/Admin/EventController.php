<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        // Admin biasanya butuh lihat data terbaru dulu (meski start_date kosong),
        // jadi urutkan dari yang terakhir dibuat.
        $items = EventItem::query()
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(12);

        return view('admin.event.index', compact('items'));
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => ['required','string','max:150'],
                'description' => ['nullable','string'],
                'content' => ['nullable','string'],
                'start_date' => ['nullable','date'],
                'end_date' => ['nullable','date','after_or_equal:start_date'],
                'location' => ['nullable','string','max:150'],
                'thumbnail' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:5120'],
                'photo' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:5120'],
                'video' => ['nullable','file','mimes:mp4,webm,ogg','max:51200'],
                'youtube_url' => ['nullable','string','max:255'],
                'is_published' => ['nullable'],
            ],
            [
                'end_date.after_or_equal' => 'Tanggal Selesai harus sama atau setelah Tanggal Mulai.',
                'thumbnail.image' => 'Thumbnail harus berupa file gambar.',
                'thumbnail.mimes' => 'Thumbnail harus berformat jpg, jpeg, png, atau webp.',
                'thumbnail.max' => 'Ukuran thumbnail maksimal 5MB.',
                'photo.image' => 'Foto harus berupa file gambar.',
                'photo.mimes' => 'Foto harus berformat jpg, jpeg, png, atau webp.',
                'photo.max' => 'Ukuran foto maksimal 5MB.',
                'video.mimes' => 'Video harus berformat mp4, webm, atau ogg.',
                'video.max' => 'Ukuran video maksimal 50MB.',
            ],
            [
                'title' => 'Judul',
                'description' => 'Deskripsi',
                'content' => 'Penjelasan Kegiatan',
                'start_date' => 'Tanggal Mulai',
                'end_date' => 'Tanggal Selesai',
                'location' => 'Lokasi',
                'thumbnail' => 'Thumbnail',
                'photo' => 'Foto',
                'video' => 'Video',
                'youtube_url' => 'YouTube URL',
            ]
        );

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('events', 'public');
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('events/photos', 'public');
        }

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('events/videos', 'public');
        }

        EventItem::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'content' => $data['content'] ?? null,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'location' => $data['location'] ?? null,
            'thumbnail_path' => $thumbnailPath,
            'photo_path' => $photoPath,
            'video_path' => $videoPath,
            'youtube_url' => $data['youtube_url'] ?? null,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.event.index')->with('ok', 'Event berhasil ditambahkan.');
    }

    public function edit(EventItem $item)
    {
        return view('admin.event.edit', compact('item'));
    }

    public function update(Request $request, EventItem $item)
    {
        $data = $request->validate(
            [
                'title' => ['required','string','max:150'],
                'description' => ['nullable','string'],
                'content' => ['nullable','string'],
                'start_date' => ['nullable','date'],
                'end_date' => ['nullable','date','after_or_equal:start_date'],
                'location' => ['nullable','string','max:150'],
                'thumbnail' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:5120'],
                'photo' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:5120'],
                'video' => ['nullable','file','mimes:mp4,webm,ogg','max:51200'],
                'youtube_url' => ['nullable','string','max:255'],
                'is_published' => ['nullable'],
            ],
            [
                'end_date.after_or_equal' => 'Tanggal Selesai harus sama atau setelah Tanggal Mulai.',
                'thumbnail.image' => 'Thumbnail harus berupa file gambar.',
                'thumbnail.mimes' => 'Thumbnail harus berformat jpg, jpeg, png, atau webp.',
                'thumbnail.max' => 'Ukuran thumbnail maksimal 5MB.',
                'photo.image' => 'Foto harus berupa file gambar.',
                'photo.mimes' => 'Foto harus berformat jpg, jpeg, png, atau webp.',
                'photo.max' => 'Ukuran foto maksimal 5MB.',
                'video.mimes' => 'Video harus berformat mp4, webm, atau ogg.',
                'video.max' => 'Ukuran video maksimal 50MB.',
            ],
            [
                'title' => 'Judul',
                'description' => 'Deskripsi',
                'content' => 'Penjelasan Kegiatan',
                'start_date' => 'Tanggal Mulai',
                'end_date' => 'Tanggal Selesai',
                'location' => 'Lokasi',
                'thumbnail' => 'Thumbnail',
                'photo' => 'Foto',
                'video' => 'Video',
                'youtube_url' => 'YouTube URL',
            ]
        );

        $item->title = $data['title'];
        $item->description = $data['description'] ?? null;
        $item->content = $data['content'] ?? null;
        $item->start_date = $data['start_date'] ?? null;
        $item->end_date = $data['end_date'] ?? null;
        $item->location = $data['location'] ?? null;
        $item->youtube_url = $data['youtube_url'] ?? null;
        $item->is_published = $request->boolean('is_published');

        if ($request->hasFile('thumbnail')) {
            if (!empty($item->thumbnail_path)) {
                Storage::disk('public')->delete($item->thumbnail_path);
            }
            $item->thumbnail_path = $request->file('thumbnail')->store('events', 'public');
        }

        if ($request->hasFile('photo')) {
            if (!empty($item->photo_path)) {
                Storage::disk('public')->delete($item->photo_path);
            }
            $item->photo_path = $request->file('photo')->store('events/photos', 'public');
        }

        if ($request->hasFile('video')) {
            if (!empty($item->video_path)) {
                Storage::disk('public')->delete($item->video_path);
            }
            $item->video_path = $request->file('video')->store('events/videos', 'public');
        }

        $item->save();

        return redirect()->route('admin.event.index')->with('ok', 'Event berhasil diupdate.');
    }

    public function destroy(EventItem $item)
    {
        if (!empty($item->thumbnail_path)) {
            Storage::disk('public')->delete($item->thumbnail_path);
        }
        if (!empty($item->photo_path)) {
            Storage::disk('public')->delete($item->photo_path);
        }
        if (!empty($item->video_path)) {
            Storage::disk('public')->delete($item->video_path);
        }
        $item->delete();
        return redirect()->route('admin.event.index')->with('ok', 'Event berhasil dihapus.');
    }
}
