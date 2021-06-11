<?php

namespace App\Http\Requests\Prices;

use App\Http\Requests\FormRequest;

class PricesStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'hourlyRate' => '//TODO required',
            'dailyRate' => '//TODO required',
        ];
    }
}
