<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Booking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'roomId',
        'clientId',
        'companyId',
        'state',
        'start',
        'end',
        'services'
    ];

    protected $_id;

    public function order ()
    {
        return $this->hasOne(Order::class);
    }

    public function rooms ()
    {
        return $this->belongsTo(Room::class)
    }

}
