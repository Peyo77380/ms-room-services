<?php

namespace App\Http\Requests\Prices;

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
            'hourlyRate' => 'integer',
            'halfDailyRate' => 'integer',
            'dailyRate'  => 'integer',
            'startDate' => 'timestamp',
            'endDate'  => 'timestamp',
            'memberDiscountAvailbable' => 'boolean'
        ];
    }
}
