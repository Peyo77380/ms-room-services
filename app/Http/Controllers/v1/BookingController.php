<?php

namespace App\Http\Controllers\v1;

use App\Models\Booking;

use App\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\BookingStoreRequest;
use App\Http\Requests\Booking\BookingUpdateRequest;
use App\Models\Room;

// TODO :
// Créer méthode qui renvoie la liste des salles disponibles entre x temps et y temps
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
     * @OA\Schema(
     *      schema="Booking_success",
     *      @OA\Property(
     *          property="message",
     *          type="string",
     *          example="Successfully got the booking list"
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
     *      path="/api/v1/booking",
     *      summary="Returns all the bookings in list.",
     *      description="Returns all the bookings saved in database in list.",
     *      operationId="get booking",
     *      tags={"booking"},
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
     *          description="Successfully got the booking list",
     *      )
     *  )
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
    /**
     * @OA\GET(
     *      path="/api/v1/booking/{id}",
     *      summary="Returns specified booking with details",
     *      description="Return the specified booking, by ID, with details",
     *      operationId="get booking by Id",
     *      tags={"booking"},
     *      @OA\Parameter(
     *          parameter="get_booking_id",
     *          name="id",
     *          description="ID of the booking",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b923547825c419083d3585"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully got the wanted booking",
     *          @OA\JsonContent(ref="#/components/schemas/Booking")
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
        return $this->jsonById($id, Booking::find($id));
    }

    /**
     * Create booking in database
     *
     * @param RoomStoreRequest $request
     * @return JSON
     */
    /**
     * @OA\Post(
     *      path="/api/v1/booking",
     *      summary="Store booking from post form",
     *      description="Store a new booking from form in database, using post method",
     *      operationId="Post new booking",
     *      tags={"booking"},
     *      @OA\Response(
     *          response=201,
     *          description="Successfully stored in database",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="datas",
     *                  type="array",
     *                  @OA\Items(),
     *                  ref="#/components/schemas/Booking"
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
    public function store(BookingStoreRequest $request)
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
    /**
     * @OA\Put(
     *      path="/api/v1/booking/{id}",
     *      summary="Update booking from put form based on ID",
     *      description="Update the targeted booking from form in database, using post method",
     *      operationId="Update booking",
     *      tags={"booking"},
     *      @OA\Parameter(
     *          parameter="get_booking_id",
     *          name="id",
     *          description="ID of the booking",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b923547825c419083d3585"
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
    public function update(BookingUpdateRequest $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return $this->jsonError('Something is wrong, please check datas - Code B30', 409);
        }

        $updatedBooking = $booking->update($request->all());

        if (!$updatedBooking) {
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
    /**
     * @OA\Delete(
     *      path="/api/v1/booking/{id}",
     *      summary="Delete booking from Delete method based on ID",
     *      description="Delete the targeted booking from form in database, using delete method",
     *      operationId="Delete booking",
     *      tags={"booking"},
     *      @OA\Parameter(
     *          parameter="get_booking_id",
     *          name="id",
     *          description="ID of the booking",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              default="60b923547825c419083d3585"
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
