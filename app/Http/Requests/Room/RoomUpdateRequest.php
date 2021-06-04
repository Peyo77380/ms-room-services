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
            'buildingId' => 'exists:App\Models\Building,_id',
            // TODO: voir avec Florian : comment identifier Floor?
            //'floorId' => 'required',
            'surface' => 'integer|min:1',
            'rules' => 'array',
            'rules.maxCapacity' => 'integer',
            'rules.minRental.unit' => 'string|size:1',
            'rules.minRental.value' => 'integer',
            'rules.public' => 'boolean',
            'rules.events' => 'boolean',
            'color' => 'string|size:7',
            'openingHours.*.day' => 'array',
            'openingHours.*.start' => 'int',
            'openingHours.*.end' => 'int',
            'enabled' => 'boolean',
            'services' => 'boolean',
            'type' => 'string'
        ];
    }
}
