<?php

namespace App\Http\Controllers;

use App\Models\EventItem;
use App\Models\HambaTuhan;
use App\Models\MajelisPeriod;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];
        $addUrl = function (string $loc, ?string $lastmod = null, ?string $changefreq = null, ?string $priority = null) use (&$urls): void {
            $urls[] = compact('loc', 'lastmod', 'changefreq', 'priority');
        };

        $now = now()->toAtomString();

        $addUrl(route('home'), $now, 'weekly', '1.0');
        $addUrl(route('gereja'), $now, 'monthly', '0.8');
        $addUrl(route('gereja.sejarah'), $now, 'monthly', '0.7');
        $addUrl(route('gereja.hamba'), $now, 'weekly', '0.7');
        $addUrl(route('gereja.majelis'), $now, 'monthly', '0.7');
        $addUrl(route('gereja.komisi'), $now, 'monthly', '0.6');
        $addUrl(route('event'), $now, 'weekly', '0.8');
        $addUrl(route('artikel'), $now, 'monthly', '0.4');
        $addUrl(route('renungan'), $now, 'monthly', '0.5');
        $addUrl(route('media'), $now, 'weekly', '0.7');
        $addUrl(route('gallery'), $now, 'weekly', '0.7');
        $addUrl(route('warta'), $now, 'weekly', '0.7');
        $addUrl(route('kontak'), $now, 'yearly', '0.4');

        try {
            if (Schema::hasTable('event_items')) {
                EventItem::query()
                    ->where('is_published', true)
                    ->orderByDesc('updated_at')
                    ->orderByDesc('id')
                    ->get(['id', 'updated_at'])
                    ->each(function (EventItem $item) use ($addUrl) {
                        $addUrl(
                            route('event.show', $item),
                            optional($item->updated_at)->toAtomString(),
                            'monthly',
                            '0.7'
                        );
                    });
            }
        } catch (\Throwable $e) {
            // Ignore DB issues for public sitemap.
        }

        try {
            if (Schema::hasTable('hamba_tuhans')) {
                HambaTuhan::query()
                    ->where('is_active', true)
                    ->orderByDesc('updated_at')
                    ->orderByDesc('id')
                    ->get(['slug', 'updated_at'])
                    ->each(function (HambaTuhan $item) use ($addUrl) {
                        $addUrl(
                            route('gereja.hamba.show', $item),
                            optional($item->updated_at)->toAtomString(),
                            'monthly',
                            '0.6'
                        );
                    });
            }
        } catch (\Throwable $e) {
            // Ignore DB issues for public sitemap.
        }

        try {
            if (Schema::hasTable('majelis_periods')) {
                MajelisPeriod::query()
                    ->orderByDesc('period')
                    ->orderByDesc('updated_at')
                    ->get(['period', 'updated_at'])
                    ->each(function (MajelisPeriod $period) use ($addUrl) {
                        $addUrl(
                            route('gereja.majelis.show', ['period' => $period->period]),
                            optional($period->updated_at)->toAtomString(),
                            'monthly',
                            '0.6'
                        );
                    });
            }
        } catch (\Throwable $e) {
            // Ignore DB issues for public sitemap.
        }

        $xml = $this->buildXml($urls);

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }

    private function buildXml(array $urls): string
    {
        $lines = ['<?xml version="1.0" encoding="UTF-8"?>'];
        $lines[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $lines[] = '  <url>';
            $lines[] = '    <loc>'.$this->xmlEscape($url['loc']).'</loc>';
            if (!empty($url['lastmod'])) {
                $lines[] = '    <lastmod>'.$this->xmlEscape($url['lastmod']).'</lastmod>';
            }
            if (!empty($url['changefreq'])) {
                $lines[] = '    <changefreq>'.$this->xmlEscape($url['changefreq']).'</changefreq>';
            }
            if (!empty($url['priority'])) {
                $lines[] = '    <priority>'.$this->xmlEscape($url['priority']).'</priority>';
            }
            $lines[] = '  </url>';
        }

        $lines[] = '</urlset>';

        return implode("\n", $lines);
    }

    private function xmlEscape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_XML1, 'UTF-8');
    }
}
