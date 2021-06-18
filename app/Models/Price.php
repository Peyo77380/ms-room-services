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
        'hourlyRate',
        'halfDailyRate',
        'dailyRate',
        'startDate',
        'endDate',
        'memberDiscountAvailbable'
    ];
    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
    public function order()
    {
        return $this->hasOne(Booking::class);
    }
}
