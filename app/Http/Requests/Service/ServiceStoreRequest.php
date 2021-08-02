<?php

namespace App\Http\Requests\Service;

use App\Http\Requests\FormRequest;

class ServiceStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'type' => 'required|numeric|gt:0|lt:3',
            'display' => 'required|string',
            'descriptionLong' => 'string',
            'descriptionShort' => 'string',
            'state' => 'required|boolean',
            'prices' => 'required',
            'prices.startDate' => 'date',
            'prices.amounts' => 'required',
            'prices.amounts.public' => 'required|numeric',
            'prices.amounts.member' => 'numeric',
            'prices.amounts.co' => 'numeric',
            'variation' => 'array'
        ];
    }
}
