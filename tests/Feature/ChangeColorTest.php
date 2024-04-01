<?php

namespace Tests\Feature;

use App\Domain\Models\TaxiColor;
use Database\Factories\TaxiFactory;
use Database\Factories\UserFactory;
use Database\Seeders\TaxiColorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangeColorTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_changes_taxi_color(): void
    {
        $user = UserFactory::new()->create();
        $taxi = TaxiFactory::new()->create();
        $this->seed(TaxiColorSeeder::class);
        $taxiColor = TaxiColor::query()->first();

        $this->actingAs($user)->post('/buy/' . $taxi->id, ['taxi_id' => $taxi->id]);

        $response = $this->actingAs($user)->post('/' . $taxi->id . '/color', ['taxiColor' => $taxiColor->id]);
        $response->assertSessionHas('success');
    }

    public function test_it_user_cant_change_color()
    {
        $user = UserFactory::new()->create();
        $taxi = TaxiFactory::new()->create();
        $this->seed(TaxiColorSeeder::class);
        $taxiColor = TaxiColor::query()->first();
        $secondTaxiColor = TaxiColor::query()->find(5);

        $this->actingAs($user)->post('/buy/' . $taxi->id, ['taxi_id' => $taxi->id]);

        $user->credit = 0;
        $user->save();

        $this->actingAs($user)->post('/' . $taxi->id . '/color', ['taxiColor' => $taxiColor->id]);

        $response = $this->actingAs($user)->post('/' . $taxi->id . '/color', ['taxiColor' => $secondTaxiColor->id]);

        $response->assertSessionHas(['error' => 'Insufficient amount of credit']);
    }
}
