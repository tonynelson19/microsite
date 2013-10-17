<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Product model
 *
 * @property int $id
 * @property int $categoryId
 * @property Category $category
 * @property string $name
 * @property string $imageUrl
 * @property string $description
 * @property string $status
 * @property bool $madeInUsa
 * @property int $order
 */
class Product extends Eloquent
{
	protected $table = 'products';

    public $timestamps = false;

    const STATUS_ACTIVE   = 'Active';
    const STATUS_INACTIVE = 'Inactive';

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
     * Get the videos associated with the product
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function videos()
    {
        return $this->hasMany('Video', 'productId');
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

    /**
     * Get made in USA
     *
     * @param string $value
     * @return bool
     */
    public function getMadeInUsaAttribute($value)
    {
        return (bool) $value;
    }
}