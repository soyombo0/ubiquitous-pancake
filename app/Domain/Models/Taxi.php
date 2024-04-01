<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Taxi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'key', 'price', 'color_id'
    ];

    public function color(): HasOne
    {
        return $this->hasOne(TaxiColor::class, 'id', 'color_id');
    }
}
