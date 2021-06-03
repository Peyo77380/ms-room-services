<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bookingId',
        'services',
        'comment',
        'discount',
        'state',
        'start',
        'end'
    ];

    protected $_id;

    public function booking ()
    {
        return $this->belongsTo(Booking::class);
    }

}
