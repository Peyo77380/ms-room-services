<?php

namespace App\Http\Controllers\v1;

use App\Models\Room;

use App\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomStoreRequest;
use App\Http\Requests\Room\RoomUpdateRequest;

class RoomController extends Controller
{
    use ApiResponder;
    private $posts;

    /**
     * @OA\GET(
     *      path="/api/v1/room",
     *      summary="Returns all the rooms in list.",
     *      description="Returns all the rooms saved in database in list.",
     *      operationId="get rooms",
     *      tags={"room"},
     *      @OA\Response(
     *          response=200,
     *          description="Successfully got the rooms",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="datas",
     *                  type="array",
     *                  @OA\Items(),
     *                  ref="#/components/schemas/Room"
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
        if ($room = Room::get()) {
            return $this->jsonSuccess($room);
        }

        return $this->jsonDatabaseError();
    }

    /**
     * @OA\GET(
     *      path="/api/v1/room/{id}",
     *      summary="Returns specified room with details",
     *      description="Return the specified room, by ID, with details",
     *      operationId="get room by Id",
     *      tags={"room"},
     *      @OA\Parameter(
     *          parameter="get_room_id",
     *          name="id",
     *          description="ID of the room",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b923bc7825c419083d3586"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully got the wanted room",
     *          @OA\JsonContent(ref="#/components/schemas/Room")
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
        return $this->jsonById($id, Room::find($id));
    }


    /**
     * @OA\Post(
     *      path="/api/v1/room",
     *      summary="Store room from post form",
     *      description="Store a new room from form in database, using post method",
     *      operationId="Post new room",
     *      tags={"room"},
     *      @OA\Response(
     *          response=201,
     *          description="Successfully stored in database",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="datas",
     *                  type="array",
     *                  @OA\Items(),
     *                  ref="#/components/schemas/Room"
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
    public function store (RoomStoreRequest $request)
    {
        $room = Room::create($request->all());
        if (!$room) {
            return $this->jsonError('Something is wrong, please check datas - Code R20', 409);
        }
        return $this->jsonSuccess($room);

    }

    /**
     * @OA\Put(
     *      path="/api/v1/room/{id}",
     *      summary="Update room from put form based on ID",
     *      description="Update the targeted room from form in database, using post method",
     *      operationId="Update room",
     *      tags={"room"},
     *      @OA\Parameter(
     *          parameter="get_room_id",
     *          name="id",
     *          description="ID of the room",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b923bc7825c419083d3586"
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
    public function update (RoomUpdateRequest $request, $id)
    {
        $room = Room::find($id);

        if (!$room) {
            return $this->jsonError('Something is wrong, please check datas - Code R30', 409);
        }

        $updatedRoom = $room->update($request->all());

        if(!$updatedRoom) {
            return $this->jsonError('Could not update this item - Code R31', 502);
        }

        return $this->jsonSuccess($updatedRoom);

    }

    /**
     * @OA\Delete(
     *      path="/api/v1/room/{id}",
     *      summary="Delete room from Delete method based on ID",
     *      description="Delete the targeted room from form in database, using delete method",
     *      operationId="Delete room",
     *      tags={"room"},
     *      @OA\Parameter(
     *          parameter="get_room_id",
     *          name="id",
     *          description="ID of the room",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b923bc7825c419083d3586"
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
    public function destroy ($id)
    {
        if (!Room::destroy($id)) {
            return $this->jsonError('Nothing found at this ID - Code R40', 404);
        }

        return $this->jsonSuccessWithoutData('Successfully deleted from database');
    }


}

