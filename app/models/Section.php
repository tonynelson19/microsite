<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Section model
 *
 * @property int $id
 * @property string $name
 * @property string $imageUrl
 * @property string $status
 * @property int $order
 */
class Section extends Eloquent
{
	protected $table = 'sections';

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
     * Get the categories associated with the section
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function categories()
    {
        return $this->hasMany('Category', 'sectionId');
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