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
        'category_id',
        'images',
        'description',
        'capacityMin',
        'capacityMax',
        'display',
        'startDate',
        'endDate',
        'status',
        'availability',
        'booking_id',
        'archived_at'
    ];

    /**
     *@OA\Property(
     *          title="_id",
     *          description="_id of the entity",
     *          type="ObjectId",
     *          example="60b794304e00fd5950e78718"
     *          )
     *
     */
    protected $_id;

    /**
     *@OA\Property(
     *          title="category_id",
     *          description="Category, fetched from MS Custom Fields",
     *          type="ObjectId",
     *          example="60b794304e00fd5950e78718"
     *          )
     *
     */
    protected $category_id;

    /**
     *@OA\Property(
     *          title="availability",
     *          description="Set the availability (private, members, public)",
     *          type="ObjectId",
     *          example="60b794304e00fd5950e78718"
     *          )
     *
     */
    protected $availability;

    /**
     *@OA\Property(
     *          title="name",
     *          description="name of the entity",
     *          type="string",
     *          example="Formation Management TPE"
     *          )
     *
     */
    protected $name;

    /**
     *@OA\Property(
     *          title="images",
     *          description="images of the event",
     *          type="ObjectId",
     *          example="60b794304e00fd5950e78718"
     *          )
     */
    protected $images;

    /**
     *@OA\Property(
     *          title="description",
     *          description="description of the entity",
     *          type="string",
     *          example="Une formation sur le Management des équipes en  TPE"
     *          )
     *
     */
    protected $description;

    /**
     *@OA\Property(
     *          title="capacityMin",
     *          description="Minimum number of person allowed to validate or the event (not blocking)",
     *          type="integer",
     *          example="0"
     *          )
     *
     */
    protected $capacityMin;

    /**
     *@OA\Property(
     *          title="capacityMax",
     *          description="Maximum number of person allowed to validate or the event (not blocking)",
     *          type="integer",
     *          example="10"
     *          )
     *
     */
    protected $capacityMax;

    /**
     *@OA\Property(
     *          title="display",
     *          description="Expected role to display the event",
     *          type="string",
     *          example="public"
     *          )
     *
     */
    protected $display;

    /**
     *@OA\Property(
     *          title="startDate",
     *          description="start of the event",
     *          type="date",
     *          example="2021-07-27T09:00:00"
     *          )
     */
    protected $startDate;

    /**
     *@OA\Property(
     *          title="endDate",
     *          description="end of the event",
     *          type="date",
     *          example="2021-07-27T18:00:00"
     *          )
     */
    protected $endDate;

    /**
     *@OA\Property(
     *          title="status",
     *          description="status of the event (activated of not",
     *          type="integer",
     *          example="1"
     *          )
     */
    protected $status;

    /**
     *@OA\Property(
     *          title="booking_id",
     *          description="Booking related to the event",
     *          type="ObjectId",
     *          example="booking_id"
     *          )
     */
    protected $booking_id;

    /**
     *@OA\Property(
     *          title="archived_at",
     *          description="Date of archiving",
     *          type="date",
     *          example="2021-07-28T00:00:00"
     *          )
     */
    protected $archived_at;



    public function bookings ()
    {
        return $this->hasOne(Room::class);
    }

    public function prices ()
    {
        return $this->hasMany(Price::class);
    }
}
