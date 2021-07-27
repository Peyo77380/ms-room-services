<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\FormRequest;

class EventUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string',
            'description' => 'string',
            'capacityMin' => 'int',
            'capacityMax' => 'int',
            'prices.startDate' => 'date',
            'prices.amounts' => 'required',
            'prices.amounts.public' => 'required|numeric',
            'prices.amounts.member' => 'numeric',
            'prices.amounts.co' => 'numeric',
            'display' => 'string',
            'startDate' => 'date',
            'endDate' => 'date',
            'status' => 'boolean'
        ];
    }
}
