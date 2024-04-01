<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaxiColor extends Model
{
    use HasFactory;

    public function taxi(): BelongsTo
    {
        return $this->belongsTo(Taxi::class);
    }
}
