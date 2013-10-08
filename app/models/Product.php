<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Product model
 *
 * @property int $id
 * @property int $categoryId
 * @property string $name
 * @property string $imageUrl
 * @property string $videoUrl
 * @property string $description
 * @property string $status
 * @property int $order
 */
class Product extends Eloquent
{
	protected $table = 'products';

    public $timestamps = false;

    const STATUS_ACTIVE   = 'active';
    const STATUS_INACTIVE = 'inactive';

    /**
     * Statuses
     *
     * @var array
     */
    public static $statuses = array(
        self::STATUS_ACTIVE   => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    );

    /**
     * Get the category associated with the product
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function category()
    {
        return $this->belongsTo('Category', 'categoryId');
    }

    /**
     * Get the images associated with the product
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function images()
    {
        return $this->hasMany('Image', 'productId');
    }

    /**
     * Only active records
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', '=', self::STATUS_ACTIVE);
    }

    /**
     * Order the records
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}