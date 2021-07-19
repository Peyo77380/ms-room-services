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
            // TODO : voir si modifiable
            'type' => 'required|numeric|gt:0|lt:3',
            'display' => 'required|string',
            'descriptionLong' => 'string',
            'descriptionShort' => 'string',
            // TODO : required?
            'key' => 'required|string',
            'state' => 'required|boolean'
            //variation?
            // image_id
        ];
    }
}
