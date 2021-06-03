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
     * Return list of all the rooms in database
     *
     * @return JSON
     */
    function get()
    {
        return $this->jsonSuccess(Room::get());
    }

    /**
     * Return one room detail, by ID
     *
     * @param  $id
     * @return JSON
     */
    function getById($id)
    {
        return $this->jsonById($id, Room::find($id));
    }


    /**
     * Create Room in database
     *
     * @param RoomStoreRequest $request
     * @return JSON
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
     * Update room in database from form by id
     *
     * @param $id
     * @param RoomUpdateRequest $request
     * @return JSON
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
     * Delete Room in database by ID
     *
     * @param  $id
     * @return JSON
     */
    public function destroy ($id)
    {
        if (!Room::destroy($id)) {
            return $this->jsonError('Nothing found at this ID - Code R40', 404);
        }

        return $this->jsonSuccessWithoutData('Successfully deleted from database');
    }



}

