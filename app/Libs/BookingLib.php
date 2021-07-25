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
        $company_id,
        $event_id
        )
    {
        $booking = new Booking();

        $saved = $booking->create([
            'start' => $start,
            'end' => $end,
            'roomd_id' => $room_id,
            'client_id' => $client_id,
            'company_id' => $company_id,
            'other' => ['event_id' => $event_id]
        ]);

        return $saved ? $saved : ['error' => true];

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
