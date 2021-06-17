<?php

namespace App\Http\Requests\Services;

use App\Http\Requests\FormRequest;

class ServicesStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'type' => 'required|string',
        ];
    }
}
