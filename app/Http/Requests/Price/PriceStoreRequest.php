<?php

namespace App\Http\Requests\Price;

use App\Http\Requests\FormRequest;

class PriceStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'hourlyRate' => 'required|number',
            'dailyRate' => 'required|number',
        ];
    }
}
