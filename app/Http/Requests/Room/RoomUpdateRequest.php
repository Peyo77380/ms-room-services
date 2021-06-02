<?php

namespace App\Http\Requests\Room;

use App\Http\Requests\FormRequest;

class RoomUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|between:5,255',
            'description' => 'string|between:10,255',
            'surface' => 'integer',
            'rules' => 'array',
            'rules.maxCapacity' => 'integer',
            'rules.minRental' => 'array',
            'rules.minRental.unit' => 'string|min:1|max:1',
            'rules.minRental.value' => 'integer',
            'rules.public' => 'boolean',
            'rules.events' => 'boolean',
            'color' => 'string|size:7',
            'openingHours' => 'array',
            'openingHours.*.day' => 'array',
            'openingHours.*.start' => 'int',
            'openingHours.*.end' => 'int',
            'enabled' => 'boolean',
            'services' => 'boolean',
            'type' => 'string'
        ];
    }
}
