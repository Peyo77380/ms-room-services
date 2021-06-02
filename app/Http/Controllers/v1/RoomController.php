<?php

namespace App\Http\Controllers\v1;

use App\Models\Room;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Room\RoomStoreRequest;

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
        if (!$image = Room::find($id)) {
            return $this->jsonError('Nothing found at this ID', 404);
        }
        return $this->jsonById($id, $image);
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
        if ($room) {
            return $this->jsonSuccess($room);
        }
        return $this->jsonError('Something is wrong, please check datas', 409);

    }



}

