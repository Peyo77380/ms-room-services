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
            // TODO : est-ce qu'une commande est FORCEMENT liée à une réserrvation de salle? ou est-ce que quelqu'un peut passer qqs minutes et prendre un café, sans forcément avoir de salle?
            'bookingId' => 'exists:App\Models\Booking,_id',
            'services.*.id' => 'exist:App\Models\Service,_id',
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
