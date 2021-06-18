<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @OA\Schema(
 *      title="Room",
 *      description="Room Model",
 *      @OA\Xml(
 *           name="Room"
 *          )
 *
 * ),
 */
class Room extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'buildingId', // TODO : foreign key
        'floorId',
        'surface',
        'rules',
        'color', // TODO : à demander au client : est-ce nécessaire de mettre un champ correspondant aux horaires d'ouvertures (si jamais une salle est ouverte moins longtemps que le batiment dans lequel elle se situe)
        'openingHours',
        'enabled',
        'services',
        'type'
    ];

    /**
     *@OA\Property(
     *          title="_id",
     *          description="_id of the entity",
     *          type="ObjectId",
     *          example="60b923bc7825c419083d3586"
     *          )
     */
    protected $_id;
    /**
     *@OA\Property(
     *          title="name",
     *          description="Name of the entity",
     *          type="string",
     *          example="La petite rouge"
     *          )
     */
    protected $name;

    /**
     *@OA\Property(
     *          title="description",
     *          description="Description of the entity",
     *          type="string",
     *          example="Petite salle de réunion cozy"
     *          )
     */
    protected $description;

    /**
     *@OA\Property(
     *          title="BuildingId",
     *          description="Building containing of the entity",
     *          type="ObjectId",
     *          example="60b62cd75a00000082007406"
     *          )
     */
    protected $buildingId;

    /**
     *@OA\Property(
     *          title="floor",
     *          description="Floor containing of the entity",
     *          type="integer",
     *          example="2"
     *          )
     */
    protected $floorId;

    /**
     *@OA\Property(
     *          title="surface",
     *          description="Surface of the entity",
     *          type="integer",
     *          example="100"
     *          )
     */
    protected $surface;

    /**
     *@OA\Property(
     *          title="rules",
     *          description="Billing, rental, and miscellanious rules applied to the entity",
     *          type="integer",
     *          example="100"
     *          )
     */
    protected $rules;

    /**
     *@OA\Property(
     *          title="color",
     *          description="Color hexadecimal code applied to the entity",
     *          type="string",
     *          example="#3333FF"
     *          )
     */
    protected $color;

    /**
     * @OA\Property(
     *          title="openingHours",
     *          type="array",
     *          @OA\Items({})
     *          )
     */
    protected $openingHours;

    /**
     *@OA\Property(
     *          title="enable",
     *          description="Room activating",
     *          type="boolean",
     *          example="true"
     *          )
     */
    protected $enabled;


    /**
     * @OA\Property(
     *          title="services",
     *          type="array",
     *          @OA\Items({})
     *          )
     */
    protected $services;

    /**
     *@OA\Property(
     *          title="type",
     *          description="Type of the entity",
     *          type="string",
     *          example="Bureau privé"
     *          )
     */
    protected $type;

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function services()
    {
        return $this->hasMany(Services::class);
    }


    // TODO : adapt select cf FRONT
    public static function searchByName($name)
    {
        return self::where('name', 'LIKE', '%' . $name . '%')->get();
    }

    public static function searchAll()
    {
        return "coucou";
    }

    public static function search($fields)
    {
        return self::where($fields)->get();
    }
}
