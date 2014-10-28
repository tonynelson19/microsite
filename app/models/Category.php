<?php

/**
 * Category model
 *
 * @property int $id
 * @property Product[] $products
 * @property int $sectionId
 * @property Section $section
 * @property string $name
 * @property string $status
 * @property int $order
 */
class Category extends Illuminate\Database\Eloquent\Model
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
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo('Section', 'sectionId');
    }

    /**
     * Get the products associated with the category
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('Product', 'categoryId');
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