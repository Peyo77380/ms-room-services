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
            // TODO : voir si modifiable
            'type' => 'numeric|gt:0|lt:3',
            'display' => 'string',
            'descriptionLong' => 'string',
            'descriptionShort' => 'string',
            // TODO : required?
            'key' => 'string',
            'state' => 'boolean',
            'prices.startDate' => 'date',
            'prices.public' => 'required|numeric',
            'prices.member' => 'numeric',
            'prices.co' => 'numeric'
            //variation?
            // image_id
        ];
    }
}
