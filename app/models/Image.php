<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Image model
 *
 * @property int $id
 * @property int $productId
 * @property Product product
 * @property string $caption
 * @property string $imageUrl
 * @property string $status
 * @property int $order
 */
class Image extends Eloquent
{
	protected $table = 'images';

    public $timestamps = false;

    const STATUS_ACTIVE   = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    const IMAGE_WIDTH  = 330;
    const IMAGE_HEIGHT = 550;

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
     * Get the product associated with the image
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function product()
    {
        return $this->belongsTo('Product', 'productId');
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