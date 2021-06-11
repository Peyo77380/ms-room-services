<?php

namespace App\Http\Requests\Services;

use App\Http\Requests\FormRequest;

class ServicesUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // TODO : à modifier en fonction du front
        ];
    }
}
