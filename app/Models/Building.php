<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

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

    // TODO : ajouter relation quand  BuildingController et RoomController OK
    // public function Rooms ()
    // {
    //     $this->hasMany(Room::class);
    // }

}
