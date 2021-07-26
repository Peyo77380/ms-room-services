<?php

namespace App\Libs;

use App\Models\Booking;
use App\Models\Room;

class BookingLib
{


    static public function findBookingByEventId ($event_id)
    {
        $booking = new Booking();

        return $booking
        ->where(
            function ($q) use ($event_id){
                $q->where('other.event_id', '=', $event_id);
            })
            ->first();
        }

    static public function makeBooking (
        $start,
        $end,
        $room_id,
        $client_id,
        $company_id = null,
        $event_id = null
        )
        {
            if (Self::__checkForRoomBooking (
                $room_id,
                $start,
                $end
                )) {
                    return ['error' => 'A booking already exists for this room at the same time.'];
                }

                $bookingData = Self::__prepareBookingData(
                    $start,
                    $end,
                    $room_id,
                    $client_id,
                    $company_id,
                    $event_id
                );

                $booking = new Booking();

                $saved = $booking->create($bookingData);

                return $saved ? $saved : ['error' => 'Could not create booking'];

            }

        static private function __checkForRoomBooking ( $room_id, $startDate, $endDate )
        {
            $booking = new Booking();

            $alreadyBooked = $booking
                ->where('room_id', '=', $room_id)
                ->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('start', [$startDate, $endDate])
                        ->orWhereBetween('end', [$startDate, $endDate])
                        ->orWhere(function ($query) use ($startDate, $endDate){
                            $query->where('start', '<=', $startDate)
                                ->where('end', '=>', $endDate);
                        });
                })
                ->count();

            return $alreadyBooked > 0;
        }

        static private function __prepareBookingData(
            $start,
            $end,
            $room_id,
            $client_id,
            $company_id = null,
            $event_id = null

            )
            {

            $bookingData = [
                'start' => $start,
                'end' => $end,
                'room_id' => $room_id,
                'client_id' => $client_id,
        ];

        if ($company_id)
        {
            $bookingData['company_id'] = $company_id;
        }
        if ($event_id)
        {
            $bookingData['other']['event_id'] = $event_id;
        }

        return $bookingData;
    }

    static public function findFreeRoom (
        $startDate,
        $endDate,
        $minCapacity = null,
        $maxCapacity = null
        )
    {
        $bookedRooms = Self::__findBookedRoomsBetweenDates(
            $startDate,
            $endDate
        );

        return Self::__findCorrespondingRoomsInArray(
            $bookedRooms,
            $minCapacity,
            $maxCapacity
        );

    }

    static private function __findBookedRoomsBetweenDates (
        $startDate,
        $endDate
        )
    {
        $bookings = Booking::whereBetween('start', [$startDate, $endDate])
            ->whereBetween('end', [$startDate, $endDate])
            ->select('room_id')
            ->get();

        $bookedRooms = [];

        foreach($bookings as $b)
        {
            $bookedRooms[] = $b['room_id'];
        }

        return $bookedRooms;
    }

    static private function __findCorrespondingRoomsInArray (
        $bookedRooms,
        $minCapacity,
        $maxCapacity
        )
    {
        return Room::
            whereNotIn('_id', $bookedRooms)
            ->when(
                $minCapacity != null,
                function ($q) use ($minCapacity){
                    $q->where('rules.minCapacity', '<=', $minCapacity);
                }
            )
            ->when(
                $maxCapacity != null,
                function ($q) use ($maxCapacity){
                    $q->where('rules.maxCapacity', '>=', $maxCapacity);
                }
            )
            ->get();
    }
}
