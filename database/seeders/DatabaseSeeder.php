<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(2)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'address' => '-',
            'phone_number' => '-',
            'isAdmin' => true
        ]);

        // Package Prewedding

        DB::table('packages')->insert([
            'category' => 'prewedding',
            'type' => 'bronze',
            'price' => '1250',
            // 'price' => '2.500.000',
            'description' => json_encode([
                '1 Photo Location.',
                '2 Photographer.',
                'Make up + hair do/Hijab.',
                '1 Print 40x60 + frame.',
                '5 Print 10 RS + Edit.',
                'Unlimited Shoot.',
                'All files in USB.'
            ]),
        ]);
        
        DB::table('packages')->insert([
            'category' => 'prewedding',
            'type' => 'silver',
            'price' => '1390',
            // 'price' => '3.900.000',
            'description' => json_encode([
                '2 Photo Location.',
                '2 Photographer.',
                'Make up + hair do/Hijab.',
                '2 Print 40x60 + frame.',
                '1 Photo Album 20x30 @ 20 page.',
                '20 Photo Edit.',
                'Unlimited Shoot.',
                'All files in USB.'
            ])
        ]);

        DB::table('packages')->insert([
            'category' => 'prewedding',
            'type' => 'gold',
            'price' => '1900',
            // 'price' => '4.900.000',
            'description' => json_encode([
                '2 Photo Location 1 Day.',
                '2 Photographer.',
                'Make up + hair do/Hijab.',
                '2 Print 50x75 + frame.',
                '2 Print 50RS + frame.',
                '1 Photo Album 20x30 @ 20 page.',
                '25 Photo Edit.',
                'Unlimited Shoot.',
                'All files in USB.'
            ]),
        ]);

        DB::table('packages')->insert([
            'category' => 'prewedding',
            'type' => 'diamond',
            'price' => '1700',
            // 'price' => '7.000.000',
            'description' => json_encode([
                '2 Day Photo Session.',
                '2 Photographer + Crew.',
                'Make up + hair do/Hijab.',
                '4 Print 50x75 + frame.',
                '4 Print 10RS + frame.',
                '5 Print 4 R + frame.',
                '1 Photo Album 20x30 @ 20 page.',
                '30 Photo Edit.',
                'Unlimited Shoot.',
                'All files in USB.'
            ]),
        ]);

        // Package Wedding

        DB::table('packages')->insert([
            'category' => 'wedding',
            'type' => 'bronze',
            'price' => '1500',
            // 'price' => '4.500.000',
            'description' => json_encode([
                'Cadid Photo.',
                '2 Photographer.',
                '1 Videographer.',
                'Video Duration 3-4 Minutes.',
                '1 Album magazine 20x30.',
                '20 Page + Laminated.',
                'Unlimited shoot.',
                'All files in USB.'
            ]),
        ]);
        
        DB::table('packages')->insert([
            'category' => 'wedding',
            'type' => 'silver',
            'price' => '1650',
            // 'price' => '6.500.000',
            'description' => json_encode([
                'Ceremonial, Candid, Family Photo.',
                'Full Lighting on Stage.',
                'Magnetic Book 4R (100 - 150 photo).',
                '1 Album magazine 20x30 @ 20 page.',
                '2 Photographer.',
                '1 Frame 40x60 + printed.',
                '1 Videographer.',
                '1 Version Instagram.',
                'Video Duration 3-4 Minutes.',
                'Unlimited shoot.',
                'All files in USB.',
            ]),
        ]);

        DB::table('packages')->insert([
            'category' => 'wedding',
            'type' => 'gold',
            'price' => '1750',
            // 'price' => '7.500.000',
            'description' => json_encode([
                'Ceremonial, Candid, Family Photo.',
                'Full Lighting on Stage.',
                'Magnetic Book 4R (100 - 150 photo).',
                '2 Album magazine 20x30 @ 20 page.',
                '2 Photographer.',
                '2 Frame 40x60 + printed.',
                '2 Videographer.',
                '1 Version Instagram.',
                'Video Duration 3-4 Minutes.',
                'Unlimited shoot.',
                'All files in USB.'
            ]),
        ]);
        

        // Package Lainnya

        DB::table('packages')->insert([
            'category' => 'lain-lain',
            'type' => 'Video Dokumentasi',
            'price' => '1950',
            // 'price' => '950.000',
            'description' => json_encode([
                'Max.3 hours',
                'Video full acara',
                'Durasi bisa 45menit -1jam',
                '1 videografer',
                'Flashdisk all files',
                'Extra hour, @ IDR 100K /hour'
            ]),
        ]);

        DB::table('packages')->insert([
            'category' => 'lain-lain',
            'type' => 'bronze',
            'sub_type' => 'wisuda, couple, familly, grup, maternity.',
            'price' => '1185',
            // 'price' => '185.000',
            'description' => 
            json_encode([
                '5 foto edit + 3 foto cetak 10 R',
                '2 foto cetak 4R',
                '1 lokasi pemotretan',
                '30 menit foto sesi',
                'tambahan all file paket bronze +100k'
            ])
        ]);
        
        DB::table('packages')->insert([
            'category' => 'lain-lain',
            'type' => 'silver',
            'sub_type' => 'wisuda, couple, familly, grup, maternity.',
            'price' => '1650',
            // 'price' => '6.500.000',
            'description' => json_encode([
                '5 foto edit + 5 foto cetak 10 R',
                '1 cetak+bingkai ukuran 30x45 (12R)',
                '1 lokasi pemotretan',
                '1 jam foto sesi'
            ]),
        ]);
    }
}
