<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
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
        return $this->hasOne(Service::class);
    }

    public function room ()
    {
        return $this->hasOne(Room::class);
    }

}
