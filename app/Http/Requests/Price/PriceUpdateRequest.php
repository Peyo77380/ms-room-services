<?php

namespace App\Http\Requests\Price;

use App\Http\Requests\FormRequest;

class PriceUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'public' => 'numeric',
            'member' => 'numeric',
            'co' => 'numeric',
            'startDate' => 'timestamp',
            'endDate'  => 'timestamp'
        ];
    }
}
