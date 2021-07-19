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
            'type' => 'string'
        ];
    }
}
