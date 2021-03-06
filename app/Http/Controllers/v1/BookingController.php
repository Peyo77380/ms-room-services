<?php

namespace App\Http\Controllers\v1;

use App\Models\Booking;

use App\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\BookingStoreRequest;
use App\Http\Requests\Booking\BookingUpdateRequest;
use App\Libs\BookingLib;

class BookingController extends Controller
{
    use ApiResponder;

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
     * @OA\GET(
     *      path="/api/v1/booking/full",
     *      summary="Returns all the bookings in list with details.",
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
    function getWithDetails (Booking $booking)
    {
        if ($result = $booking->with('room')->get()) {
            return $this->jsonSuccess($result);
        }

        return $this->jsonDatabaseError('Unable to reache database - B10');
    }


    /**
     * @OA\GET(
     *      path="/api/v1/booking/calendat",
     *      summary="Returns array with datas for calendar display",
     *      description="Returns all the bookings saved in database in database, with datas for calendar display.",
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
    function getCalendarDetails (Booking $booking)
    {
        if ($result = $booking->with('room')->get()) {
            foreach ($result as $el) {
                if (isset($el['room']['color'])) {
                    $el['color'] = $el['room']['color'];
                }

                $el['title'] = "Reservation";

                if (isset($el['client_id'])) {
                    $el['title'] = "Client : " . $el['client_id'];
                }
                if (isset($el['company_id'])) {

                    $el['title'] .= " - Company : " . $el['company_id'];
                }
            }
            return $this->jsonSuccess($result);
        }

        return $this->jsonDatabaseError('Unable to reache database - B10');
    }



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
        $booking = BookingLib::makeBooking(
            $request->input('start'),
            $request->input('end'),
            $request->input('room_id'),
            $request->input('client_id'),
            $request->input('company_id')
        );

        if (isset($booking['error'])) {
            return $this->jsonError($booking['error'], 409);
        }
        return $this->jsonSuccess($booking);
    }

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

}
