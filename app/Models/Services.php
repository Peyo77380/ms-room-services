<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'price',
        'enable',
        'availability'
    ];
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
