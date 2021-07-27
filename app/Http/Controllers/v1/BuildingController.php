<?php

namespace App\Http\Controllers\V1;

use App\Traits\ApiResponder;

use App\Http\Controllers\Controller;

use App\Models\Building;

use App\Http\Requests\Building\BuildingStoreRequest;
use App\Http\Requests\Building\BuildingUpdateRequest;
use App\Libs\ImageLib;

class BuildingController extends Controller
{
    use ApiResponder;

    /**
     * @OA\Schema(
     *      schema="Building_success",
     *      @OA\Property(
     *          property="message",
     *          type="string",
     *          example="Successfully got the building list"
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
     *      path="/api/v1/building",
     *      summary="Returns all the buildings in list.",
     *      description="Returns all the building saved in database in list.",
     *      operationId="get building",
     *      tags={"building"},
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
     *          description="Successfully got the building list",
     *      )
     *  )
     */
    function get()
    {
        if ($buildings = Building::get()) {
            return $this->jsonSuccess($buildings);
        }
        return $this->jsonError('Not found.', 404);
    }

    /**
     * @OA\GET(
     *      path="/api/v1/building/{id}",
     *      summary="Returns specified building with details",
     *      description="Return the specified building, by ID, with details",
     *      operationId="get building by Id",
     *      tags={"building"},
     *      @OA\Parameter(
     *          parameter="get_building_id",
     *          name="id",
     *          description="ID of the building",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b5dd464e00fd5950e78717"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully got the wanted building",
     *          @OA\JsonContent(ref="#/components/schemas/Building")
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
        if ($building = Building::find($id)) {
            return $this->jsonById($id, $building);
        }
        return $this->jsonError('Not found at id ' . $id . '.', 404);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/builing/{id}",
     *      summary="Delete builing from Delete method based on ID",
     *      description="Delete the targeted builing from form in database, using delete method",
     *      operationId="Delete builing",
     *      tags={"building"},
     *      @OA\Parameter(
     *          parameter="get_builing_id",
     *          name="id",
     *          description="ID of the builing",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b5dd464e00fd5950e78717"
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
        if (Building::destroy($id)) {
            return $this->jsonSuccess('item : ' . $id . ' successfully deleted', Building::destroy($id), 204);
        }

        return $this->jsonError('Cannot delete building', 409);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/building/add",
     *      summary="Add building from post form",
     *      description="Add a new building from form in database, using post method",
     *      operationId="Post new building",
     *      tags={"building"},
     *      @OA\Response(
     *          response=201,
     *          description="Successfully stored in database",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="datas",
     *                  type="array",
     *                  @OA\Items(),
     *                  ref="#/components/schemas/Building"
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
    public function add(BuildingStoreRequest $request)
    {
        $building = new Building($request->all());

        if ($request->file()) {
            $image = new ImageLib();
            $savedImage = $image->saveImage($request);

            if (!$savedImage) {
                return $this->jsonError('Could not save image', 409);
            }
            $building->images = $savedImage->_id;
        }


        if ($building->save()) {
            return $this->jsonSuccess($building, 'Created', 201);
        }

        return $this->jsonError('Could not create. Check datas again', 409);
    }

    /**
     * @OA\Put(
     *      path="/api/v1/building/{id}",
     *      summary="Update building from put form based on ID",
     *      description="Update the targeted building from form in database, using post method",
     *      operationId="Update building",
     *      tags={"building"},
     *      @OA\Parameter(
     *          parameter="get_building_id",
     *          name="id",
     *          description="ID of the building",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b5dd464e00fd5950e78717"
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
    public function update($id, BuildingUpdateRequest $request)
    {
        $building = Building::find($id);

        if (!$building) {
            return $this->jsonError('Nothing found at id ' . $id . '.', 404);
        }

        $building->fill($request->all());

        if ($request->file()['file']) {
            $image = new ImageLib();
            $savedImage = $image->saveImage($request);

            if (!$savedImage) {
                return $this->jsonError('Could not save image', 409);
            }

            $building->images = $savedImage->_id;
        }

        if ($building->save()) {
            return $this->jsonSuccess($building, 'Updated');
        };
        return $this->jsonError('Something went wrong', 409);


    }
}


