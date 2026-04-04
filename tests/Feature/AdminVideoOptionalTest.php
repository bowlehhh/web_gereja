<?php

namespace Tests\Feature;

use App\Models\EventItem;
use App\Models\MediaItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminVideoOptionalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        if (! extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('pdo_sqlite tidak tersedia di environment ini.');
        }

        parent::setUp();
    }

    public function test_media_can_be_created_without_youtube_url(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.media.store'), [
            'title' => 'Ibadah Minggu Pagi',
            'speaker' => 'Pdt. Samuel',
            'service_at' => '2026-04-04 09:00:00',
            'youtube_url' => '',
            'is_published' => '1',
        ]);

        $response->assertSessionHasErrors(['thumbnail']);
        $response->assertSessionDoesntHaveErrors(['youtube_url']);
    }

    public function test_event_can_be_created_without_video_upload(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.event.store'), [
            'title' => 'Kebaktian Paskah',
            'description' => 'Deskripsi singkat',
            'content' => 'Penjelasan lengkap kegiatan.',
            'start_date' => '2026-04-10',
            'end_date' => '2026-04-10',
            'location' => 'GKKA Samarinda',
            'is_published' => '1',
        ]);

        $response->assertSessionHasErrors(['thumbnail', 'photo']);
        $response->assertSessionDoesntHaveErrors(['video']);
    }

    public function test_media_can_be_updated_without_reuploading_thumbnail_or_video_link(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $media = MediaItem::create([
            'title' => 'Media Lama',
            'speaker' => 'Pdt. Lama',
            'service_at' => '2026-04-01 09:00:00',
            'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'youtube_id' => 'dQw4w9WgXcQ',
            'thumbnail_path' => 'media/thumbnails/lama.webp',
            'is_published' => true,
        ]);

        $response = $this->actingAs($admin)->put(route('admin.media.update', $media), [
            'title' => 'Media Baru',
            'speaker' => 'Pdt. Baru',
            'service_at' => '2026-04-05 09:00:00',
            'youtube_url' => '',
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.media.index'));
        $response->assertSessionHasNoErrors();

        $media->refresh();

        $this->assertSame('Media Baru', $media->title);
        $this->assertNull($media->youtube_url);
        $this->assertNull($media->youtube_id);
        $this->assertSame('media/thumbnails/lama.webp', $media->thumbnail_path);
    }

    public function test_event_can_be_updated_without_reuploading_photo_thumbnail_or_video(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $event = EventItem::create([
            'title' => 'Event Lama',
            'description' => 'Deskripsi lama',
            'content' => 'Isi lama',
            'start_date' => '2026-04-01',
            'end_date' => '2026-04-02',
            'location' => 'Lokasi lama',
            'thumbnail_path' => 'events/thumb.webp',
            'photo_path' => 'events/photos/detail.webp',
            'video_path' => 'events/videos/lama.mp4',
            'is_published' => true,
        ]);

        $response = $this->actingAs($admin)->put(route('admin.event.update', $event), [
            'title' => 'Event Baru',
            'description' => 'Deskripsi baru',
            'content' => 'Isi baru',
            'start_date' => '2026-04-10',
            'end_date' => '2026-04-11',
            'location' => 'Lokasi baru',
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.event.index'));
        $response->assertSessionHasNoErrors();

        $event->refresh();

        $this->assertSame('Event Baru', $event->title);
        $this->assertSame('events/thumb.webp', $event->thumbnail_path);
        $this->assertSame('events/photos/detail.webp', $event->photo_path);
        $this->assertSame('events/videos/lama.mp4', $event->video_path);
    }
}
