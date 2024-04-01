<?php

namespace App\Presentation\Controllers;

use App\Application\Requests\BuyRequest;
use App\Application\Services\TaxiService;
use App\Domain\Models\Taxi;
use App\Domain\Models\TaxiColor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home()
    {
        $taxis = Taxi::all();

        return view('taxi_list', [
            'taxis' => $taxis,
        ]);
    }

    public function list()
    {
        $taxiColors = TaxiColor::all();

        return view('taxi_purchased', [
            'userTaxis' => Auth::user()->taxis,
            'taxiColors' => $taxiColors,
        ]);
    }

    public function buy(BuyRequest $request, Taxi $taxi)
    {
        $proccess = TaxiService::validateAndBuy(Auth::user(), $taxi);

        if ($proccess !== true) {
            return redirect()->route('app')->with('error', $proccess);
        }

        return redirect()->route('app')->with('success', 'Вы приобрели машину');
    }

    public function changeTaxiColor(Request $request, Taxi $taxi)
    {
        $service = TaxiService::changeColor(auth()->user(), $taxi, $request);

        if ($service !== true) {
            return redirect()->route('taxi.list')->with('error', $service);
        }

        return redirect()->route('taxi.list')->with('success', 'Вы покрасили машину');
    }
}
