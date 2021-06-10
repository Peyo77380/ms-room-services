<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @OA\Schema(
 *      title="Service",
 *      description="Service Model",
 *      @OA\Xml(
 *           name="Service"
 *          )
 *
 * ),
 */
class Services extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'price',
        'startDate',
        'endDate',
        'memberDiscountAvailable'
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
     *          title="name",
     *          description="Name",
     *          type="string",
     *          example="café"
     *          )
     *
     */
    protected $name;

    /**
     *@OA\Property(
     *          title="type",
     *          description="Type",
     *          type="integer",
     *          example="1"
     *          )
     *
     */
    protected $type;

    /**
     *@OA\Property(
     *          title="description",
     *          description="Description",
     *          type="string",
     *          example="Café expresso de notre cafétaria"
     *          )
     */
    protected $description;

    /**
     *@OA\Property(
     *          title="price",
     *          description="Price",
     *          type="ObjectId",
     *          example="60b8d5d74e00fd5950e78719"
     *          )
     */
    protected $price;

    /**
     *@OA\Property(
     *          title="Availability start date",
     *          description="Availability start date",
     *          type="date",
     *          example="2021-06-10 00H00"
     *          )
     */
    protected $startDate;

    /**
     *@OA\Property(
     *          title="Availability end date",
     *          description="Availability end date",
     *          type="date",
     *          example="2021-06-11 00H00"
     *          )
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
    protected $memberDiscountAvailable;


    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    /* public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    } */
    public function room()
    {
        return $this->belongsToMany(Room::class);
    }

}
