<?php

namespace App\View\Components;

use App\Domain\Models\TaxiColor;
use App\Domain\Models\UserTaxi;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class MyTaxiCard extends Component
{
    public function __construct(public UserTaxi $taxi, public Collection|TaxiColor $taxiColors)
    {

    }

    public function render(): View|Closure|string
    {
        return view('components.my-taxi-card', ['taxi' => $this->taxi, 'taxiColors' => $this->taxiColors]);
    }
}
