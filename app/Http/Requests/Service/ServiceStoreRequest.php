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
            'type' => 'required|string'
        ];
    }
}
