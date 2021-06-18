<?php

namespace App\Http\Controllers\V1;

use App\Traits\ApiResponder;

use App\Http\Controllers\Controller;

use App\Models\Service;
use Illuminate\Http\Request;

use App\Http\Requests\Services\ServicesStoreRequest;
use App\Http\Requests\Services\ServicesUpdateRequest;

class ServiceController extends Controller
{
    use ApiResponder;

    /**
     * @OA\GET(
     *      path="/api/v1/service",
     *      summary="Returns all the services in list.",
     *      description="Returns all the services saved in database in list.",
     *      operationId="get services",
     *      tags={"service"},
     *      @OA\Response(
     *          response=200,
     *          description="Successfully got the services",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="datas",
     *                  type="array",
     *                  @OA\Items(),
     *                  ref="#/components/schemas/Service"
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
        return $this->jsonSuccess(Service::get());
    }


    /**
     * @OA\GET(
     *      path="/api/v1/service/{id}",
     *      summary="Returns specified service with details",
     *      description="Return the specified service, by ID, with details",
     *      operationId="get service by Id",
     *      tags={"service"},
     *      @OA\Parameter(
     *          parameter="get_service_id",
     *          name="id",
     *          description="ID of the service",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b8d5d74e00fd5950e78719"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully got the wanted service",
     *          @OA\JsonContent(ref="#/components/schemas/Service")
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
        return $this->jsonById($id, Service::find($id));
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/service/{id}",
     *      summary="Delete service from Delete method based on ID",
     *      description="Delete the targeted service from form in database, using delete method",
     *      operationId="Delete service",
     *      tags={"service"},
     *      @OA\Parameter(
     *          parameter="get_service_id",
     *          name="id",
     *          description="ID of the service",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b794304e00fd5950e78718"
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
        return $this->jsonSuccess('item : ' . $id . ' successfully deleted', Service::destroy($id), 204);
    }


    /**
     * @OA\Post(
     *      path="/api/v1/service",
     *      summary="Store service from post form",
     *      description="Store a new service from form in database, using post method",
     *      operationId="Post new service",
     *      tags={"service"},
     *      @OA\Response(
     *          response=201,
     *          description="Successfully stored in database",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="datas",
     *                  type="array",
     *                  @OA\Items(),
     *                  ref="#/components/schemas/Service"
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
    public function add(ServicesStoreRequest $request)
    {
        $services = new Service($request->all());
        $services->save();
    }


    /**
     * @OA\Put(
     *      path="/api/v1/service/{id}",
     *      summary="Update service from put form based on ID",
     *      description="Update the targeted service from form in database, using post method",
     *      operationId="Update service",
     *      tags={"service"},
     *      @OA\Parameter(
     *          parameter="get_service_id",
     *          name="id",
     *          description="ID of the service",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b927367825c419083d3588"
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
    public function update($id, ServicesStoreRequest $request)
    {
        $services = Service::find($id);
        $services->fill($request->all());
        $services->save();
    }
}
