<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        // TODO : foreign key
        'targetId',
        'image',
        'path',
        'title'
    ];
    protected $_id;

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
    public function room()
    {
        return $this->belongsTo(Building::class);
    }

}
