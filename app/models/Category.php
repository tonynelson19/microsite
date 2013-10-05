<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Category model
 *
 * @property int $id
 * @property int $sectionId
 * @property string $name
 * @property int $order
 */
class Category extends Eloquent
{
	protected $table = 'categories';

    public $timestamps = false;

    /**
     * Products
     *
     * @var Product[]
     */
    protected $products;

    /**
     * Get the section associated with the category
     *
     * @return Section
     */
    public function section()
    {
        return $this->belongsTo('Section', 'sectionId');
    }

    /**
     * Find all products for the category
     *
     * @return Product[]
     */
    public function products()
    {
        if (is_null($this->products)) {
            $this->products = Product::where('categoryId', '=', $this->id)->orderBy('order', 'asc')->get();
        }
        return $this->products;
    }
}