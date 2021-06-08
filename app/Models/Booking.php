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
        'booking_id',
        'clientId',
        'companyId',
        'state',
        'start',
        'end',
        'services'
    ];

   // protected $_id;

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }
    public function building()
    {
        return $this->belongsTo(Building::class);
    }
    public function prices()
    {
        return $this->hasOne(Prices::class);
    }
    public function services()
    {
        return $this->hasMany(Services::class);
    }
}
