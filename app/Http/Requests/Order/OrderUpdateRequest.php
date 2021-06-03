<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\FormRequest;

class OrderUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'bookingId' => 'exist:App\Models\Building,_id',
            // 'services.*.id' => 'exist:App\Models\Service,_id',
            //TODO : changer qd bookinController et serviceController OK les deux lignes commentées
            'bookingId' => 'int',
            'services.*.id' => 'int',
            'services.*.qty' => 'int|min:1',
            'comment' => 'string',
            'discount' => 'string',
            'state' => 'int|between:0,5',
            'start' => 'date_format:d-m-Y H:i',
            'end' => 'date_format:d-m-Y H:i'
        ];
    }
}
