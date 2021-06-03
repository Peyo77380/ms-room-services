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
            'buildingId' => 'required|exist:App\Models\Building,_id',
            // TODO: voir avec Florian : comment identifier Floor?
            //'floorId' => 'required',
            'surface' => 'integer|min:1',
            'rules' => 'required|array',
            'rules.maxCapacity' => 'integer',
            'rules.minRental.unit' => 'string|size:1',
            'rules.minRental.value' => 'integer',
            'rules.public' => 'boolean',
            'rules.events' => 'boolean',
            'color' => 'string|size:7',
            'openingHours.*.day' => 'array',
            'openingHours.*.start' => 'int',
            'openingHours.*.end' => 'int',
            'enabled' => 'required|boolean',
            'services' => 'boolean',
            'type' => 'string'
        ];
    }
}
