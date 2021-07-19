<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @OA\Schema(
 *      title="Service",
 *      description="Service Model",
 *      @OA\Xml(
 *           name="Service"
 *          )
 *
 * ),
 */
class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type', // 1 = product, 2 = service
        'category_id', // Category Id from ms-customFields
        'display', // Display privilege to the role (and under) (eg : admin, member, shop) => default value by front : admin
        'descriptionLong',
        'descriptionShort',
        'archived_at',
        // TODO : image_id
        'key',
        'state', // Activated or not,
        'content', // TODO : A quoi ça correspond?
        // TODO : A voir avec Flo : 'variation'
    ];

    /**
     *@OA\Property(
     *          title="_id",
     *          description="_id of the entity",
     *          type="ObjectId",
     *          example="60b794304e00fd5950e78718"
     *          )
     *
     */
    protected $_id;

    /**
     *@OA\Property(
     *          title="name",
     *          description="Name",
     *          type="string",
     *          example="café"
     *          )
     *
     */
    protected $name;

    /**
     *@OA\Property(
     *          title="type",
     *          description="Type",
     *          type="integer",
     *          example="1"
     *          )
     *
     */
    protected $type;

    /**
     *@OA\Property(
     *          title="description",
     *          description="Description",
     *          type="string",
     *          example="Café expresso de notre cafétaria"
     *          )
     */
    protected $description;

    /**
     *@OA\Property(
     *          title="archived_at",
     *          description="Archiving date",
     *          type="string",
     *          example="2021-07-19T14:41:26+00:00"
     *          )
     */
    protected $archived_at;

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function room()
    {
        return $this->belongsToMany(Room::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

}
