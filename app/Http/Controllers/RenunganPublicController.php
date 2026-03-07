<?php

namespace App\Http\Controllers;

use App\Models\RenunganItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class RenunganPublicController extends Controller
{
    public function index()
    {
        $items = collect();

        try {
            if (Schema::hasTable('renungan_items')) {
                $items = RenunganItem::query()
                    ->where('is_published', true)
                    ->orderBy('sort_order')
                    ->orderByDesc('published_at')
                    ->orderByDesc('id')
                    ->get();
            }
        } catch (\Throwable $e) {
            $items = collect();
        }

        return view('pages.renungan', compact('items'));
    }

    public function show(RenunganItem $renunganItem)
    {
        abort_unless($renunganItem->is_published, 404);

        return view('pages.renungan-show', [
            'item' => $renunganItem,
        ]);
    }

    public function random(): JsonResponse
    {
        try {
            if (!Schema::hasTable('renungan_items')) {
                return response()->json([
                    'message' => 'Data renungan belum tersedia.',
                ], 404);
            }

            $item = RenunganItem::query()
                ->where('is_published', true)
                ->inRandomOrder()
                ->first();

            if (!$item) {
                return response()->json([
                    'message' => 'Belum ada renungan yang dipublish.',
                ], 404);
            }

            $lines = preg_split('/\R+/', trim((string) $item->content)) ?: [];
            $lines = array_values(array_filter(array_map('trim', $lines), fn ($line) => $line !== ''));

            $isiHtml = collect($lines)
                ->take(12)
                ->map(fn ($line) => '<p>'.e($line).'</p>')
                ->implode('');

            if ($isiHtml === '') {
                $isiHtml = '<p>'.e((string) $item->excerpt).'</p>';
            }

            $category = 'RENUNGAN';
            $reference = trim((string) $item->scripture_reference);
            if ($reference !== '') {
                $parts = preg_split('/[\s:]+/', $reference);
                $candidate = trim((string) ($parts[0] ?? ''));
                if ($candidate !== '') {
                    $category = Str::upper($candidate);
                }
            }

            return response()->json([
                'id' => $item->id,
                'slug' => $item->slug,
                'judul' => $item->title,
                'ayat' => $item->scripture_reference,
                'kategori' => $category,
                'tanggal' => optional($item->published_at)->translatedFormat('d F Y'),
                'penulis' => $item->author,
                'isi' => $item->content,
                'isi_html' => $isiHtml,
                'url' => route('renungan.show', $item),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil renungan random.',
            ], 500);
        }
    }
}
