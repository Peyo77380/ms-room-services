<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Events extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'photo',
        'description',
        'capacityMin',
        'capacityMax',
        'price',
        'rezervedMembers',
        'date',
        'statute'
    ];
}
