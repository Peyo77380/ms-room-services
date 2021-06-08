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


    public function Rooms ()
    {
        $this->hasMany(Room::class);
    }

    public static function search ($fields)
    {
        return self::where($fields)->get();
    }
}
