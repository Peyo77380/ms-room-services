<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\FormRequest;

class EventStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'capacityMin' => 'int',
            'capacityMax' => 'int',
            'prices' => 'required',
            'prices.startDate' => 'date',
            'prices.amounts' => 'required',
            'prices.amounts.public' => 'required|numeric',
            'prices.amounts.member' => 'numeric',
            'prices.amounts.co' => 'numeric',
            'display' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'status' => 'required|boolean',
            'category_id' => 'required|string'
        ];
    }
}
