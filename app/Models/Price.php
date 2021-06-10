<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @OA\Schema(
 *      title="Price",
 *      description="Price Model",
 *      @OA\Xml(
 *           name="Price"
 *          )
 *
 * ),
 */
class Price extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hourlyRate',
        'halfDailyRate',
        'dailyRate',
        'startDate',
        'endDate',
        'memberDiscountAvailbable'
    ];

    /**
     *@OA\Property(
     *          title="_id",
     *          description="_id of the entity",
     *          type="ObjectId",
     *          example="60b8d5d74e00fd5950e78719"
     *          )
     */
    protected $_id;

    /**
     *@OA\Property(
     *          title="hourlyRate",
     *          description="Price by hour",
     *          type="float",
     *          example="50.00"
     *          )
     */
    protected $hourlyRate;

    /**
     *@OA\Property(
     *          title="halfDailyRate",
     *          description="Price by half day",
     *          type="float",
     *          example="180.00"
     *          )
     *
     */
    protected $halfDailyRate;

    /**
     *@OA\Property(
     *          title="dailyRate",
     *          description="Price by day",
     *          type="float",
     *          example="300.00"
     *          )
     *
     */
    protected $dailyRate;

    /**
     *@OA\Property(
     *          title="startDate",
     *          description="First day of application",
     *          type="date",
     *          example="2021-06-10 00H00"
     *          )
     *
     */
    protected $startDate;

    /**
     *@OA\Property(
     *          title="endDate",
     *          description="Last day of application",
     *          type="date",
     *          example="2021-06-15 00H00"
     *          )
     *
     */
    protected $endDate;

    /**
     *@OA\Property(
     *          title="Member availability available",
     *          description="Member availability available",
     *          type="boolean",
     *          example="true"
     *          )
     */
    protected $memberDiscountAvailbable;





    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
    public function order()
    {
        return $this->hasOne(Booking::class);
    }
}
