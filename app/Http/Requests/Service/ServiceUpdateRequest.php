<?php

namespace App\Http\Requests\Service;

use App\Http\Requests\FormRequest;

class ServiceUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string',
            'display' => 'string',
            'descriptionLong' => 'string',
            'descriptionShort' => 'string',
            'state' => 'boolean',
            'prices.startDate' => 'date',
            'prices.amounts' => 'required_if:prices,true',
            'prices.amounts.public' => 'required_if:prices,true|numeric',
            'prices.amounts.member' => 'numeric',
            'prices.amounts.co' => 'numeric',
            'variation' => 'array'
            // image_id
        ];
    }
}
