<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\FormRequest;

class EventStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'photo' => 'required',
            'description' => 'required|string',
            'capacityMin' => 'required|int',
            'capacityMax' => 'int|int',
            'price' => 'required|int',
            'rezervedMembers' => 'required|boolean',
            'date' => 'required|date_format:d-m-Y H:i',
            'statute' => 'required|int'

        ];
    }
}
