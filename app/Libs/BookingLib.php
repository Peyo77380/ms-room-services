<?php

namespace App\Libs;

use App\Models\Booking;
use App\Models\Room;
use Mockery\Undefined;

class BookingLib
{
    static public function findFreeRoom ($startDate, $endDate, $minCapacity = null, $maxCapacity = null)
    {
        $bookedRooms = Self::__findBookedRoomsBetweenDates($startDate, $endDate);

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

    static private function __findBookedRoomsBetweenDates ($startDate, $endDate)
    {
        $bookings = Booking::whereBetween('start', [$startDate, $endDate])->whereBetween('end', [$startDate, $endDate])->select('room_id')->get();

        $bookedRooms = [];

        foreach($bookings as $b)
        {
            $bookedRooms[] = $b['room_id'];
        }

        return $bookedRooms;
    }
}
