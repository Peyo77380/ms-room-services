<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\FormRequest;

class OrderStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // TODO : est-ce qu'une commande est FORCEMENT liée à une réserrvation de salle? ou est-ce que quelqu'un peut passer qqs minutes et prendre un café, sans forcément avoir de salle?
            //TODO : changer qd bookinController et serviceController OK les deux lignes commentées
            // 'bookingId' => 'required|exist:App\Models\Building,_id',
            // 'services.*.id' => 'required|exist:App\Models\Service,_id',
            'bookingId' => 'int',
            'services.*.id' => 'int',
            'services.*.qty' => 'required|int|min:1',
            'comment' => 'string',
            'discount' => 'string',
            'state' => 'required|int|between:0,5',
            'start' => 'required|date_format:d-m-Y H:i',
            'end' => 'required|date_format:d-m-Y H:i'
        ];
    }
}
