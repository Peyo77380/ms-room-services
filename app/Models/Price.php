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
        'relatedEntityType' //0: room, 1: service/product
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function room ()
    {
        return $this->hasOne(Room::class);
    }

}
