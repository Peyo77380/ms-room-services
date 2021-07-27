<?php

namespace App\Http\Requests\Room;

use App\Http\Requests\FormRequest;

class RoomSearchRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'start' => 'required|date',
            'end' => 'required|date',
            'minCapacity' => 'integer|gt:0',
            'minCapacity' => 'integer|gt:0'
        ];
    }
}
