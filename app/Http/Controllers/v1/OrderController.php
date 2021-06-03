<?php

namespace App\Http\Controllers\v1;

use App\Models\Order;

use App\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderStoreRequest;
use App\Http\Requests\Order\OrderUpdateRequest;

class OrderController extends Controller
{
    use ApiResponder;

    /**
     * Return list of all the orders in database
     *
     * @return JSON
     */
    function get()
    {
        if ($order = Order::get()) {
            return $this->jsonSuccess($order);
        }

        return $this->jsonDatabaseError();
    }

    /**
     * Return one order detail, by ID
     *
     * @param  $id
     * @return JSON
     */
    function getById($id)
    {
        return $this->jsonById($id, Order::find($id));
    }


    /**
     * Create Order in database
     *
     * @param OrderStoreRequest $request
     * @return JSON
     */
    public function store (OrderStoreRequest $request)
    {
        $order = Order::create($request->all());
        if (!$order) {
            return $this->jsonError('Something is wrong, please check datas - Code R20', 409);
        }
        return $this->jsonSuccess($order, 'Ordre created');

    }

    /**
     * Update update in database from form by id
     *
     * @param $id
     * @param OrderUpdateRequest $request
     * @return JSON
     */
    public function update (OrderUpdateRequest $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return $this->jsonError('Something is wrong, please check datas - Code R30', 409);
        }

        $updatedOrder = $order->update($request->all());

        if(!$updatedOrder) {
            return $this->jsonError('Could not update this item - Code R31', 502);
        }

        return $this->jsonSuccess($updatedOrder);

    }

    /**
     * Delete order in database by ID
     *
     * @param  $id
     * @return JSON
     */
    public function destroy ($id)
    {
        if (!Order::destroy($id)) {
            return $this->jsonError('Nothing found at this ID - Code R40', 404);
        }

        return $this->jsonSuccessWithoutData('Successfully deleted from database');
    }

}

