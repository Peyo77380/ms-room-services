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
            'room_id' => 'required|exists:App\Models\Room,_id',
            // TODO : a vérifier au moment où client ID sera accessible (cf MS-CRM)
            'client_id' => 'required|int',
            // TODO : a vérifier au moment où company ID sera accessible (cf MS-CRM)
            'company_id' => 'int',
            'state' => 'int|between:0,5',
            'start' => 'required|date_format:"Y-m-d\TH:i:s"',
            'end' => 'required|date_format:"Y-m-d\TH:i:s"'
            // si besoin du format avec fuseau horaire : Y-m-d\TH:i:sP
        ];
    }
}
