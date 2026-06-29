<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name'         => 'speak-and-shine',
                'display_name' => 'Speak & Shine — First Impression Mode ON',
                'description'  => 'Belajar speaking untuk first impression yang memukau.',
                'price'        => 0,
                'is_free'      => true,
                'kategori'     => 'English',
                'sort_order'   => 1,
            ],
            [
                'name'         => 'speak-without-template',
                'display_name' => 'Speak Without Template',
                'description'  => 'Belajar speaking tanpa bergantung pada template.',
                'price'        => 50000,
                'is_free'      => false,
                'kategori'     => 'English',
                'sort_order'   => 2,
            ],
            [
                'name'         => 'real-life-english',
                'display_name' => 'Real Life English Survival',
                'description'  => 'Belajar English untuk kebutuhan kehidupan sehari-hari.',
                'price'        => 60000,
                'is_free'      => false,
                'kategori'     => 'English',
                'sort_order'   => 3,
            ],
            [
                'name'         => 'socially-fluent',
                'display_name' => 'Socially Fluent',
                'description'  => 'Belajar speaking untuk sosialisasi dan percakapan sosial.',
                'price'        => 100000,
                'is_free'      => false,
                'kategori'     => 'English',
                'sort_order'   => 4,
            ],
        ];

        foreach ($packages as $package) {
            Package::firstOrCreate(
                ['name' => $package['name']], // cek by slug agar tidak duplikat
                $package
            );
        }
    }
}
