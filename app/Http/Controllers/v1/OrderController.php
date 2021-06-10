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
     * @OA\Schema(
     *      schema="Order_success",
     *      @OA\Property(
     *          property="message",
     *          type="string",
     *          example="Successfully got the order list"
     *          ),
     *      @OA\Property(
     *          property="status",
     *          type="string",
     *          example="success"
     *          ),
     *      @OA\Property(
     *           property="time",
     *           type="string",
     *           example="Current time"
     *           ),
     *      @OA\Property(
     *           property="data",
     *           type="string",
     *           example="test"
     *           )
     * )
     */

    /**
     * @OA\GET(
     *      path="/api/v1/order",
     *      summary="Returns all the orders in list.",
     *      description="Returns all the orders saved in database in list.",
     *      operationId="get orders",
     *      tags={"order"},
     *      @OA\Response(
     *          response=404,
     *          description="Nothing found",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Not found"
     *              ),
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="error"
     *              ),
     *              @OA\Property(
     *                  property="time",
     *                  type="string",
     *                  example="Current time"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Database error",
     *          @OA\JsonContent(
     *               @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Database error"
     *                  ),
     *               @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="error"
     *                  ),
     *               @OA\Property(
     *                  property="time",
     *                  type="string",
     *                  example="Current time"
     *                  )
     *           )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully got the order list",
     *      )
     *  )
     */
    function get()
    {
        if ($order = Order::get()) {
            return $this->jsonSuccess($order);
        }
        return $this->jsonDatabaseError();
    }


    /**
     * @OA\GET(
     *      path="/api/v1/order/{id}",
     *      summary="Returns specified order with details",
     *      description="Return the specified order, by ID, with details",
     *      operationId="get orders by Id",
     *      tags={"order"},
     *      @OA\Parameter(
     *          parameter="get_order_id",
     *          name="id",
     *          description="ID of the order",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b927367825c419083d3588"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully got the wanted order",
     *          @OA\JsonContent(ref="#/components/schemas/Order")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Nothing found",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Not found"
     *                 ),
     *              @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="error"
     *                 ),
     *              @OA\Property(
     *                  property="time",
     *                  type="string",
     *                  example="Current time"
     *                  )
     *           )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Database error",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Database error"
     *                  ),
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="error"
     *                  ),
     *              @OA\Property(
     *                  property="time",
     *                  type="string",
     *                  example="Current time"
     *                  )
     *           )
     *      )
     * )
     */
    function getById($id)
    {
        if (Order::find($id)) {
            return $this->jsonById($id, Order::find($id));
        }
        return $this->jsonError('Not found', 404);
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
            return $this->jsonError('Something is wrong, please check datas - Code O20', 409);
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
            return $this->jsonError('Something is wrong, please check datas - Code O30', 409);
        }

        $updatedOrder = $order->update($request->all());

        if(!$updatedOrder) {
            return $this->jsonError('Could not update this item - Code O31', 502);
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
            return $this->jsonError('Nothing found at this ID - Code O40', 404);
        }

        return $this->jsonSuccessWithoutData('Successfully deleted from database');
    }

}
