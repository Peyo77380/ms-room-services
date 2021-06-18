<?php

namespace App\Http\Controllers\V1;

use App\Traits\ApiResponder;

use App\Http\Controllers\Controller;

use App\Models\Price;
use App\Http\Requests\Prices\PriceStoreRequest;

class PriceController extends Controller
{
    use ApiResponder;

    /**
     * @OA\GET(
     *      path="/api/v1/price",
     *      summary="Returns all the prices in list.",
     *      description="Returns all the price saved in database in list.",
     *      operationId="get price",
     *      tags={"price"},
     *      @OA\Response(
     *          response=200,
     *          description="Successfully got the prices",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="datas",
     *                  type="array",
     *                  @OA\Items(),
     *                  ref="#/components/schemas/Price"
     *               )
     *           )
     *      ),
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
     *      )
     *  )
     */
    function get()
    {
        return $this->jsonSuccess(Price::get());
    }

    /**
     * @OA\GET(
     *      path="/api/v1/price/{id}",
     *      summary="Returns specified price with details",
     *      description="Return the specified price, by ID, with details",
     *      operationId="get price by Id",
     *      tags={"price"},
     *      @OA\Parameter(
     *          parameter="get_price_id",
     *          name="id",
     *          description="ID of the price",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b8d5d74e00fd5950e78719"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully got the wanted price",
     *          @OA\JsonContent(ref="#/components/schemas/Price")
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
        return $this->jsonById($id, Price::find($id));
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/price/{id}",
     *      summary="Delete price from Delete method based on ID",
     *      description="Delete the targeted price from form in database, using delete method",
     *      operationId="Delete price",
     *      tags={"price"},
     *      @OA\Parameter(
     *          parameter="get_price_id",
     *          name="id",
     *          description="ID of the price",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b8d5d74e00fd5950e78719"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Succesfully deleted",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Successfully deleted"
     *                  ),
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="success"
     *                  ),
     *              @OA\Property(
     *                  property="time",
     *                  type="string",
     *                  example="Current time"
     *                  )
     *           )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="ID not found",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Nothing found at this ID"
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
    public function destroy($id)
    {
        return $this->jsonSuccess('item : ' . $id . ' successfully deleted', Price::destroy($id), 204);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/price",
     *      summary="Store price from post form",
     *      description="Store a new price from form in database, using post method",
     *      operationId="Post new price",
     *      tags={"price"},
     *      @OA\Response(
     *          response=201,
     *          description="Successfully stored in database",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="datas",
     *                  type="array",
     *                  @OA\Items(),
     *                  ref="#/components/schemas/Price"
     *              )
     *          )
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
    public function add(PriceStoreRequest $request)
    {
        $services = new Price($request->all());
        $services->save();
    }

    /**
     * @OA\Put(
     *      path="/api/v1/price/{id}",
     *      summary="Update price from put form based on ID",
     *      description="Update the targeted price from form in database, using post method",
     *      operationId="Update price",
     *      tags={"price"},
     *      @OA\Parameter(
     *          parameter="get_price_id",
     *          name="id",
     *          description="ID of the price",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b8d5d74e00fd5950e78719"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Succesfully updated",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Successfully updated"
     *                  ),
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="success"
     *                  ),
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
    public function update($id, PriceStoreRequest $request)
    {
        $services = Price::find($id);
        $services->fill($request->all());
        $services->save();
    }
}
