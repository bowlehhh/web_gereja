<?php

namespace Tests\Feature;

use App\Http\Middleware\TrackWebsiteVisit;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BidangPelayananFeatureTest extends TestCase
{
    public function test_public_dashboard_renders_gracefully_without_data_source(): void
    {
        $this->withoutMiddleware(TrackWebsiteVisit::class);

        $response = $this->get(route('gereja.komisi'));

        $response
            ->assertOk()
            ->assertSee('Bidang Pelayanan')
            ->assertSee('Bidang pelayanan belum ditambahkan');
    }

    public function test_admin_store_rejects_member_photo_larger_than_twelve_mb(): void
    {
        $this->withoutMiddleware(TrackWebsiteVisit::class);
        Storage::fake('public');

        $user = User::factory()->make();
        $oversizedPhoto = UploadedFile::fake()->create('anggota.jpg', 13000, 'image/jpeg');

        $response = $this->actingAs($user)->post(route('admin.bidang.store'), [
            'name' => 'Bidang Multimedia',
            'slug' => 'bidang-multimedia',
            'description' => 'Melayani multimedia dan siaran ibadah.',
            'service_year' => 2026,
            'member_photo' => $oversizedPhoto,
            'sort_order' => 1,
            'is_active' => '1',
        ]);

        $response->assertSessionHasErrors(['member_photo']);
    }
}
