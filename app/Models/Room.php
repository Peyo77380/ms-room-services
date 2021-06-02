<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Jenssegers\Mongodb\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        // TODO : foreign key
        'buildingId',
        // TODO : foreign key
        'floorId',
        'surface',
        'rules',
        'color',
        // TODO : à demander au client : est-ce nécessaire de mettre un champ correspondant aux horaires d'ouvertures (si jamais une salle est ouverte moins longtemps que le batiment dans lequel elle se situe)
        'openingHours',
        'enabled',
        'services',
        'type'
    ];

    // TODO : ajouter relation quand  BuildingController et RoomController OK
    // public function building ()
    // {
    //     return $this->belongsTo(Building::class);
    // }

}
