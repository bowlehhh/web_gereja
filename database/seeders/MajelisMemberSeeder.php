<?php

namespace Database\Seeders;

use App\Models\MajelisMember;
use Illuminate\Database\Seeder;

class MajelisMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seed = [
            [
                'name' => 'Ketua Majelis',
                'role' => 'Ketua Majelis',
                'period' => 'Periode 2026',
                'excerpt' => 'Melayani dan mengarahkan pelayanan majelis jemaat.',
                'about' => 'Isi profil Ketua Majelis (bisa diubah nanti lewat database).',
                'sort_order' => 1,
            ],
            [
                'name' => 'Sekretaris',
                'role' => 'Sekretaris',
                'period' => 'Periode 2026',
                'excerpt' => 'Mengelola administrasi dan dokumentasi pelayanan.',
                'about' => 'Isi profil Sekretaris (bisa diubah nanti lewat database).',
                'sort_order' => 2,
            ],
            [
                'name' => 'Bendahara',
                'role' => 'Bendahara',
                'period' => 'Periode 2026',
                'excerpt' => 'Mengelola keuangan jemaat dengan akuntabel.',
                'about' => 'Isi profil Bendahara (bisa diubah nanti lewat database).',
                'sort_order' => 3,
            ],
            [
                'name' => 'Anggota Majelis',
                'role' => 'Anggota',
                'period' => 'Periode 2026',
                'excerpt' => 'Bekerja sama dalam pelayanan dan penggembalaan.',
                'about' => 'Isi profil Anggota Majelis (bisa diubah nanti lewat database).',
                'sort_order' => 4,
            ],
        ];

        foreach ($seed as $row) {
            MajelisMember::query()->updateOrCreate(
                ['name' => $row['name'], 'period' => $row['period']],
                $row
            );
        }
    }
}

