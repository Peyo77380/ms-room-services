<?php

namespace App\Http\Requests\Building;

use App\Http\Requests\FormRequest;

class BuildingUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //TODO : mettre à jour quand front OK
            'surface' => 'integer|min:0',
            'openingHours' => '',
            'characteristics' => '',
            // 'pictures.*.ext' => 'required|between:3,4'
        ];
    }
}
