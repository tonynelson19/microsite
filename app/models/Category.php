<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Category model
 *
 * @property int $id
 * @property int $sectionId
 * @property Section $section
 * @property string $name
 * @property string $status
 * @property int $order
 */
class Category extends Eloquent
{
	protected $table = 'categories';

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
     * Get the section associated with the category
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function section()
    {
        return $this->belongsTo('Section', 'sectionId');
    }

    /**
     * Get the products associated with the category
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function products()
    {
        return $this->hasMany('Product', 'categoryId');
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