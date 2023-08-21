<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategoryGroupSeeder::class,
            CategorySeeder::class,
            SettingSeeder::class,
        ]);

        $out = new ConsoleOutput();
        $out->writeln("  Start User factory");
        User::factory(10)->create();

        $out->writeln("  Start Brand factory");
        Brand::factory(10)->create();

        $out->writeln("  Start Product factory");
        Product::factory(100)->create();

        $out->writeln("  Start Offer factory");
        Offer::factory(200)->create()->each(function(Offer $offer) {
            Image::factory()->state([
                    'entity_type' => 'Offer',
                    'entity_id' => $offer->id,
                ])
                ->withFolder('offers')
                ->create();
        });

    }
}
