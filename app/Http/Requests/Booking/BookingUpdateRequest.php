<?php

namespace App\Http\Requests\Booking;

use App\Http\Requests\FormRequest;

class BookingUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'roomId' => 'exists:App\Models\Room,_id',
            // TODO : a vérifier au moment où client ID sera accessible (cf MS-CRM)
            'clientId' => 'int',
            // TODO : a vérifier au moment où company ID sera accessible (cf MS-CRM)
            'companyId' => 'int',
            'state' => 'int|between:0,5',
            'start' => 'date_format:"Y-m-d\TH:i:s"',
            'end' => 'date_format:"Y-m-d\TH:i:s"',
        ];
    }
}
