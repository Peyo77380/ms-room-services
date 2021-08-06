<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Price extends Model
{


    /**
     * @OA\Schema(
     *      title="Service",
     *      description="Service Model",
     *      @OA\Xml(
     *           name="Service"
     *          )
     * ),
     */
    protected $fillable = [
        'startDate',
        'endDate',
        'amounts',
        'relatedEntityId',
        'relatedEntityType' //0: room, 1: service/ 2 : product, 3 : event
    ];


    /**
     *@OA\Property(
     *          title="startDate",
     *          description="first day of the price activity",
     *          type="date",
     *          example="2021-07-27T00:00:00"
     *          )
     */
    protected $startDate;

    /**
     *@OA\Property(
     *          title="endDate",
     *          description="last day of the price activity",
     *          type="date",
     *          example="2021-07-28T00:00:00"
     *          )
     */
    protected $endDate;

    /**
     *@OA\Property(
     *          title="amounts",
     *          description="list of the prices",
     *          type="array",
     *          @OA\Items({})
     *          )
     */
    protected $amounts;

    /**
     *@OA\Property(
     *          title="relatedEntityType",
     *          description="Type of the related entity",
     *          type="integer",
     *          example="1"
     *          )
     */
    protected $relatedEntityType;

    /**
     *@OA\Property(
     *          title="relatedEntityId",
     *          description="ID of the entity",
     *          type="ObjectId",
     *          example="60b794304e00fd5950e78718"
     *          )
     */
    protected $relatedEntityId;

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function room ()
    {
        return $this->belongsTo(Room::class);
    }

    public function event ()
    {
        return $this->belongsTo(Event::class);
    }

}
