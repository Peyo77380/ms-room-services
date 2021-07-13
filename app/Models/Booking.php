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
 *
 * ),
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
        'clientId',
        'companyId',
        'state',
        'start',
        'end'
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
     *
     *@OA\Property(
     *          title="orderId",
     *          type="ObjectId",
     *          example="60b927367825c419083d3588"
     *          )
     */
    protected $order_id;

    /**
     *
     *@OA\Property(
     *          title="clientId",
     *          type="integer",
     *          example="112"
     *          )
     */
    protected $clientId;

    /**
     *
     *@OA\Property(
     *          title="companyId",
     *          type="integer",
     *          example="2"
     *          )
     */
    protected $companyId;

    /**
     * @OA\Property(
     *          title="state",
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
     *          type="timestamp",
     *          example="1621987200"
     *          )
     */
    protected $start;

    /**
     *
     *@OA\Property(
     *          title="end",
     *          type="timestamp",
     *          example="1622073600"
     *          )
     */
    protected $end;

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
