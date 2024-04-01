<?php

namespace Database\Seeders;

use App\Domain\Models\TaxiColor;
use Illuminate\Database\Seeder;

class TaxiColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = ['Red', 'Blue', 'Yellow'];

        foreach ($colors as $color) {
            TaxiColor::create([
                'name' => $color
            ]);
        }
    }
}
