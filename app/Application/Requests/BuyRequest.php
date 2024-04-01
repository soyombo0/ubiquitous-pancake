<?php

namespace App\Application\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'taxi_id' => 'required|exists:taxis,id',
        ];
    }
}
