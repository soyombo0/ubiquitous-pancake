<?php

namespace App\Application\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeTaxiColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $taxi = $this->route('taxi');
        $userTaxi = auth()->user()->taxis()->where('taxi_id', $taxi->id)->first();

        return isset($userTaxi);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
