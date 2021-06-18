<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @OA\Schema(
 *      title="Order",
 *      description="Order Model",
 *      @OA\Xml(
 *           name="Order"
 *          )
 *
 * ),
 */
class Order extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bookingId',
        'services',
        'comment',
        'discount',
        'state',
        'start',
        'end'
    ];
    /**
     *@OA\Property(
     *          title="_id",
     *          description="_id of the entity",
     *          type="ObjectId",
     *          example="60b927367825c419083d3588"
     *          )
     *
     */
    protected $_id;

    /**
     *
     *@OA\Property(
     *          title="bookingId",
     *          type="ObjectId",
     *          example="60b923547825c419083d3585"
     *          )
     */
    protected $bookingId;

     /**
      * @OA\Property(
      *          title="services",
      *          type="array",
      *          @OA\Items({})
      *          )
      */
    protected $services;

    /**
      * @OA\Property(
      *          title="comment",
      *          type="string",
      *          example = "Intolérent au lactose"
      *          )
      */
    protected $comment;

    /**
      * @OA\Property(
      *          title="discount",
      *          type="string",
      *          example = "CouponABC123"
      *          )
      */
    protected $discount;

    /**
      * @OA\Property(
      *          title="discount",
      *          type="integer",
      *          example = "1"
      *          )
      * 0 => commandé
      * 1 => validé
      * 2 => annulé par le client
      * 3 => annulé par l'espace de coworking
      */
    protected $state;

    /**
     * @OA\Property(
     *      title="start",
     *      type="date",
     *      example="2021-06-09 17H00"
     * )
     */
    protected $start;

    /**
     * @OA\Property(
     *      title="end",
     *      type="date",
     *      example="2021-06-09 19H00"
     * )
     */
    protected $end;


    public function booking ()
    {
        return $this->hasOne(Booking::class);
    }
    public function services ()
    {
         return $this->belongsToMany(Service::class);
    }

}
