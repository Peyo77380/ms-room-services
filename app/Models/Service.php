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
        'variation'
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
     *          title="category_id",
     *          description="Category Id from ms-customFields",
     *          type="string",
     *          example="Food"
     *          )
     */
    protected $category_id;

    /**
     *@OA\Property(
     *          title="display",
     *          description="Allow displaying depending on user role",
     *          type="string",
     *          example="member"
     *          )
     */
    protected $display;

    /**
     *@OA\Property(
     *          title="descriptionLong",
     *          description="Long description of the service or product",
     *          type="string",
     *          example="This is a really long description of our perfect product"
     *          )
     */
    protected $descriptionLong;

    /**
    *@OA\Property(
    *          title="descriptionShort",
    *          description="Short description of the service or product",
    *          type="string",
    *          example="Short description of our product"
    *          )
    */
    protected $descriptionShort;

    /**
    *@OA\Property(
    *          title="archived_at",
    *          description="Archiving date",
    *          type="string",
    *          example="2021-07-19T14:41:26+00:00"
    *          )
    */
    protected $archived_at;

    /**
    *@OA\Property(
    *          title="state",
    *          description="Activate the product for users or not",
    *          type="boolean",
    *          example="TRUE"
    *          )
    */
    protected $state;

    /**
    *@OA\Property(
    *          title="variation",
    *          description="Different variations of a product",
    *          type="array",
    *          example="TRUE"
    *          )
    */
    protected $variation;

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
