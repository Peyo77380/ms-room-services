<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Building extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location',
        'surface',
        'openingHours',
        'description',
        'pictures',
        'characterics',
        'state',
        'enabled',
        'floors'
    ];

    protected $_id;

    // TODO : ajouter relation quand  BuildingController et RoomController OK
    // public function Rooms ()
    // {
    //     $this->hasMany(Room::class);
    // }

}
