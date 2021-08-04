<?php

namespace App\Http\Controllers\V1;

use App\Libs\PriceLibs;

use App\Models\Service;
use App\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceStoreRequest;
use App\Http\Requests\Service\ServiceUpdateRequest;

class ServiceController extends Controller
{
    use ApiResponder;
    /**
     * @OA\GET(
     *      path="/api/v1/service",
     *      summary="Returns all the active services in list.",
     *      description="Returns all the active services saved in database in list.",
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
        $services = Service::whereNull('archived_at')->get();

        foreach($services as $el) {
            $el->prices = PriceLibs::find($el['type'], $el['_id']);
        }
        return $this->jsonSuccess($services);
    }

    /**
     * @OA\GET(
     *      path="/api/v1/service",
     *      summary="Returns archived the services in list.",
     *      description="Returns all the archived services saved in database in list.",
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
    function getArchived()
    {
        $services = Service::whereNotNull('archived_at')->get();

        foreach($services as $el) {
            $el->prices = PriceLibs::find($el['type'], $el['_id']);
        }
        return $this->jsonSuccess($services);
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
        $service = Service::find($id);
        $service->prices = PriceLibs::find($service['type'], $service['_id']);
        return $this->jsonById($id, $service);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/service/{id}",
     *      summary="Delete (archive) service from Delete method based on ID",
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
        if ($service = Service::find($id)) {
            $archived = $service->update(["archived_at" => date_format(now(), 'c')]);
            return $this->jsonSuccess('item : ' . $id . ' successfully archived',$archived, 204);
        }
        return $this->jsonError('Nothing found at this ID - Code R40', 404);
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
    public function add(ServiceStoreRequest $request)
    {
        $service = new Service($request->all());

        if ($service->save()) {

            $prices = PriceLibs::set($service->type, $service->_id, $request->input('prices'));
            
            if ($prices) {
                $service->prices = $prices;
                return $this->jsonSuccess($service, 'Created', 201);
            }

            return $this->jsonError('Could not create the prices. Check datas again', 409);
        }


        return $this->jsonError('Could not create. Check datas again', 409);
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
     *          response=200,
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
    public function update($id, ServiceUpdateRequest $request)
    {
        $service = Service::find($id);

        if (!$service) {
            return $this->jsonError('Nothing found at id ' . $id . '.', 404);
        }

        $type = $service->type;
        // type & category_id are fixed and cannot be change
        $service->fill($request->except(['category_id', 'type']));

        if ($request->input('prices')) {
            $prices = PriceLibs::replace($type, $service->_id, $request->input('prices'));

            if(isset($prices['error'])) {
                return $this->jsonError('Could not update this item - Code R31', 502);
            }

            $service->prices = $prices;
        }

        if ($service->save()) {
            return $this->jsonSuccess($service, 'Updated');
        };
        return $this->jsonError('Something went wrong', 409);

    }
}
