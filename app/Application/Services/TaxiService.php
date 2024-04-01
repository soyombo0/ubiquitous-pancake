<?php

namespace App\Application\Services;

use App\Domain\Models\Taxi;
use App\Domain\Models\TaxiColor;
use App\Domain\Models\User;
use App\Domain\Models\UserTaxi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxiService
{
    public static function validateAndBuy(User $user, Taxi $taxi): bool|string|null
    {
        if ($validate = self::canBuy($user, $taxi)) {
            return $validate;
        }

        return self::buy($user, $taxi);
    }

    private static function buy(User $user, Taxi $taxi): bool
    {
        UserService::decreaseCredits($user, $taxi->price);

        $userTaxi = new UserTaxi();
        $userTaxi->user_id = $user->id;
        $userTaxi->taxi_id = $taxi->id;
        $userTaxi->price = $taxi->price;
        $userTaxi->save();

        return true;
    }

    public static function canBuy(User $user, Taxi $taxi): ?string
    {
        if ($user->credit < $taxi->price) {
            return 'Not enough credit.';
        }

        return null;
    }

    public static function changeColor(User $user, Taxi $taxi, Request $request): bool|string
    {
        DB::beginTransaction();
        $taxiColor = TaxiColor::find($request->get('taxiColor'));
        $taxi = Taxi::query()->lockForUpdate()->find($taxi->id);

        if ($user->credit < $taxiColor->price && $user->changed_taxi_color) {
            return 'Insufficient amount of credit';
        }

        if (isset($taxiColor)) {
            $taxi->color_id = $taxiColor->id;

            if ($user->changed_taxi_color) {
                $user->credit -= $taxiColor->price;
            }

            $user->changed_taxi_color = true;

            $user->save();
            $taxi->save();
            DB::commit();
        }

        return true;
    }
}
