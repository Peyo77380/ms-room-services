<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @OA\Schema(
 *      title="Building",
 *      description="Building Model",
 *      @OA\Xml(
 *           name="Building"
 *          )
 *
 * ),
 */
class Building extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
        'surface',
        'openingHours',
        'description',
        'images',
        'characterics',
        'state',
        'enabled',
        'floors'
    ];

    /**
     *@OA\Property(
     *          title="_id",
     *          description="_id of the entity",
     *          type="ObjectId",
     *          example="60b5dd464e00fd5950e78717"
     *          )
     */
    protected $_id;

    /**
     *@OA\Property(
     *          title="location",
     *          description="location",
     *          type="ObjectId",
     *          example="{address, city, zipCode, country, lat, long}"
     *          )
     */
    protected $location;

    /**
     *@OA\Property(
     *          title="surface",
     *          description="surface of location",
     *          type="integer",
     *          example="200"
     *          )
     */
    protected $surface;

    /**
     *@OA\Property(
     *          title="openingHours",
     *          description="building opening time ",
     *          type="array",
     *           @OA\Items({})
     *          )
     */
    protected $openingHours;

    /**
     *@OA\Property(
     *          title="description",
     *          description="description of the building",
     *          type="string",
     *          example="Building of Art"
     *          )
     */
    protected $description;

    /**
     *@OA\Property(
     *          title="images",
     *          description="images of the building",
     *          type="array",
     *          @OA\Items({})
     *          )
     */
    protected $images;

    /**
     *@OA\Property(
     *          title="characterics",
     *          description="characterics of the building",
     *          type="string",
     *          example="Soundproof building "
     *          )
     */
    protected $characterics;

    /**
     * @OA\Property(
     *          title="state",
     *          type="integer",
     *          example = "1"
     *          )
     * 0 => open
     * 1 => temporarily closed
     */
    protected $state;

    /**
     * @OA\Property(
     *          title="enabled",
     *          type="boolean",
     *          example = "true"
     *          )
     */
    protected $enabled;

    /**
     * @OA\Property(
     *          title="floors",
     *          type="object",
     *          example = ""
     *          )
     */
    protected $floors;



    public function Rooms()
    {
        $this->hasMany(Room::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function services()
    {
        return $this->hasMany(Services::class);
    }

    public static function search($fields)
    {
        return self::where($fields)->get();
    }
}
