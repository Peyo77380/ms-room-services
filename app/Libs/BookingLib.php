<?php

namespace App\Libs;

use App\Models\Booking;
use App\Models\Room;

class BookingLib
{
    static public function findFreeRoom ($startDate, $endDate = null, $minCapacity = 0, $maxCapacity = 0)
    {

        // trouver les salles qui n'ont pas de reservation à partir de startDate
        // trouver les salles qui n'ont pas de reservation jusqu'à endDate
        // trouver les salles qui ont au moins minCapacity
        // trouver les salles qui ont au plus maxCapacity

        $bookings = Booking::whereBetween('start', [$startDate, $endDate])->whereBetween('end', [$startDate, $endDate])->select('room_id')->get();

        $bookedRooms = [];

        foreach($bookings as $b)
        {
            $bookedRooms[] = $b['room_id'];
        }
        return Room::
            whereNotIn('_id', $bookedRooms)
            // ->where('rules.minCapacity', '=<', null)
            // ->where('rules.maxCapacity', '>=', 0)
            ->get();
    }
}
