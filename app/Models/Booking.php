<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @OA\Schema(
 *      title="Booking",
 *      description="Booking Model",
 *      @OA\Xml(
 *           name="Booking"
 *          )
 * )
 */
class Booking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'room_id',
        'client_id',
        'company_id',
        'state',
        'start',
        'end',
        'other',
        'archived_at'
    ];

   /**
     *@OA\Property(
     *          title="_id",
     *          description="_id of the entity",
     *          type="ObjectId",
     *          example="60b923547825c419083d3585"
     *          )
     *
     */
    protected $_id;

    /**
    *@OA\Property(
    *          title="archived_at",
    *          description="Archiving date",
    *          type="string",
    *          example="2021-07-19T14:41:26+00:00"
    *          )
    */
    protected $archived_at;

    /**
     *
     *@OA\Property(
     *          title="orderId",
     *          description="order related to this booking",
     *          type="ObjectId",
     *          example="60b927367825c419083d3588"
     *          )
     */
    protected $order_id;

    /**
     *
     *@OA\Property(
     *          title="clientId",
     *          description="Client ID",
     *          type="integer",
     *          example="112"
     *          )
     */
    protected $client_id;

    /**
     *
     *@OA\Property(
     *          title="company_id",
     *          description="Company Id",
     *          type="integer",
     *          example="2"
     *          )
     */
    protected $company_id;

    /**
     * @OA\Property(
     *          title="state",
     *          description="Status of the booking",
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
     *
     *@OA\Property(
     *          title="start",
     *          description="Date of the beginning",
     *          type="timestamp",
     *          example="1621987200"
     *          )
     */
    protected $start;

    /**
     *
     *@OA\Property(
     *          title="end",
     *          description="Date of the end",
     *          type="timestamp",
     *          example="1622073600"
     *          )
     */
    protected $end;


    /**
     *
     *@OA\Property(
     *          title="other",
     *          type="array"
     *          )
     */
    protected $other;

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function price ()
    {
        return $this->hasOne(Price::class);
    }

    public function event ()
    {
        return $this->hasOne(Event::class);
    }
}
