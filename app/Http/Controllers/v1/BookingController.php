<?php

namespace App\Http\Controllers\v1;

use App\Models\Booking;

use App\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\BookingStoreRequest;
use App\Http\Requests\Booking\BookingUpdateRequest;
use App\Models\Room;

class BookingController extends Controller
{
    use ApiResponder;
    private $posts;

    /**
     * Return list of all the rooms in database
     *
     * @return JSON
     */
    /**
 * @OA\GET(
 * path="/booking/",
 * summary="Get all bookings",
 * description="Get all bookings",
 * operationId="get booking",
 * tags={"booking"},
 * @OA\RequestBody(
 *    required=false,
 *    description=""
 * ),
 * @OA\Response(
 *    response=404,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Not found")
 *        )
 *     )
 * )
 */
     function get()
    {
        if ($booking = Booking::get()) {
            return $this->jsonSuccess($booking);
        }

        return $this->jsonDatabaseError('Unable to reache database - B10');
    }

    /**
     * Return one booking detail, by ID
     *
     * @param  $id
     * @return JSON
     */
    function getById($id)
    {
        return $this->jsonById($id, Booking::find($id));
    }

    /**
     * Create booking in database
     *
     * @param RoomStoreRequest $request
     * @return JSON
     */
    public function store (BookingStoreRequest $request)
    {
        $booking = Booking::create($request->all());
        if (!$booking) {
            return $this->jsonError('Something is wrong, please check datas - Code B20', 409);
        }
        return $this->jsonSuccess($booking);
    }

    /**
     * Update booking in database from form by id
     *
     * @param $id
     * @param BookingUpdateRequest $request
     * @return JSON
     */
    public function update (BookingUpdateRequest $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return $this->jsonError('Something is wrong, please check datas - Code B30', 409);
        }

        $updatedBooking = $booking->update($request->all());

        if(!$updatedBooking) {
            return $this->jsonError('Could not update this item - Code R31', 502);
        }

        return $this->jsonSuccess($updatedBooking);

    }

    /**
     * Delete booking in database by ID
     *
     * @param  $id
     * @return JSON
     */
    public function destroy ($id)
    {
        if (!Booking::destroy($id)) {
            return $this->jsonError('Nothing found at this ID - Code B40', 404);
        }

        return $this->jsonSuccessWithoutData('Successfully deleted from database');
    }
    public function getWithDetails()
    {
        return Booking::find(1)->order();
    }

}

