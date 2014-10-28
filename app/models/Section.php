<?php

/**
 * Section model
 *
 * @property int $id
 * @property Category[] $categories
 * @property string $name
 * @property string $imageUrl
 * @property string $status
 * @property int $order
 */
class Section extends Illuminate\Database\Eloquent\Model
{
	protected $table = 'sections';

    public $timestamps = false;

    const STATUS_ACTIVE   = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    const IMAGE_WIDTH  = 224;
    const IMAGE_HEIGHT = 130;

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
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany('Category', 'sectionId');
    }

    /**
     * Only active records
     *
     * @param Illuminate\Database\Query\Builder $query
     * @return Illuminate\Database\Query\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', '=', self::STATUS_ACTIVE);
    }

    /**
     * Order the records
     *
     * @param Illuminate\Database\Query\Builder $query
     * @return Illuminate\Database\Query\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}