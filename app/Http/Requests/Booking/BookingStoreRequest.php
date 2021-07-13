<?php

namespace App\Http\Requests\Booking;

use App\Http\Requests\FormRequest;

class BookingStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'roomId' => 'required|exists:App\Models\Room,_id',
            // TODO : a vérifier au moment où client ID sera accessible (cf MS-CRM)
            'clientId' => 'required|int',
            // TODO : a vérifier au moment où company ID sera accessible (cf MS-CRM)
            'companyId' => 'int',
            'state' => 'int|between:0,5',
            'start' => 'required|date_format:d-m-Y H:i',
            'end' => 'required|date_format:d-m-Y H:i',
        ];
    }
}
