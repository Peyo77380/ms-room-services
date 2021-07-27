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
            'buildingId' => 'required|exists:App\Models\Building,_id',
            // TODO: voir avec Florian : comment identifier Floor?
            //'floorId' => 'required',
            'surface' => 'integer|min:1',
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
            'type' => 'string',
            'prices' => 'required',
            'prices.amounts.hourly' => 'required',
            'prices.amounts.daily' => 'required',
            'prices.amounts.halfDaily' => 'required',
            'prices.amounts' => 'required',
            'prices.amounts.*.public' => 'required|numeric|gt:0',
            'prices.startDate' => 'date'
        ];
    }
}
