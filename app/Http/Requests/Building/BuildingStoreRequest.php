<?php

namespace App\Http\Requests\Building;

use App\Http\Requests\FormRequest;

class BuildingStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'location.address' => 'required',

            // 'pictures.*.ext' => 'required|between:3,4'
        ];
    }
}
