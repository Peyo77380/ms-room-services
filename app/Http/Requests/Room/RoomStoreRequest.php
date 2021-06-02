<?php

namespace App\Http\Requests\Room;

use App\Http\Requests\FormRequest;

class RoomStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|between:5,255',
            'description' => 'required|string|between:10,255',
            'buildingId' => 'required',
            'floorId' => 'required',
            'surface' => 'integer',
            'rules' => 'required|array',
            'rules.maxCapacity' => 'integer',
            'rules.minRental' => 'array',
            'rules.minRental.unit' => 'string|min:1|max:1',
            'rules.minRental.value' => 'integer',
            'rules.public' => 'boolean',
            'rules.events' => 'boolean',
            'color' => 'string|min:7|max:7',
            'openingHours' => 'array',
            'openingHours.*.day' => 'required_if:openingHours,true|array',
            'openingHours.*.start' => 'required_if:openingHours,true|int',
            'openingHours.*.end' => 'required|int',
            'enabled' => 'required|boolean',
            'services' => 'boolean',
            'type' => 'string'
        ];
    }
}
