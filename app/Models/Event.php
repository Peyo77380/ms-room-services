<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'images',
        'description',
        'capacityMin',
        'capacityMax',
        'display',
        'startDate',
        'endDate',
        'status',
        'booking_id',
        'archived_at'
    ];

    /**
     *@OA\Property(
     *          title="images",
     *          description="images of the building",
     *          type="array",
     *          @OA\Items({})
     *          )
     */
    protected $images;


    public function bookings ()
    {
        return $this->hasOne(Room::class);
    }

    public function prices ()
    {
        return $this->hasMany(Price::class);
    }
}
