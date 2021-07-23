<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        // 'images',
        'description',
        'capacityMin',
        'capacityMax',
        'price',
        'availability',
        'startDate',
        'endDate',
        'status'
        // TODO :
        // type: possible de réserver si membre ou public
        // TODO : voir si ajouter booking ?
    ];
}
