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

        ];
    }
}
