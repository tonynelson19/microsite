<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Product model
 *
 * @property int $id
 * @property int $categoryId
 * @property string $name
 * @property string $image
 * @property string $video
 * @property string $description
 * @property int $order
 */
class Product extends Eloquent
{
	protected $table = 'products';

    public $timestamps = false;

    /**
     * Images
     *
     * @var Image[]
     */
    protected $images;

    /**
     * Get the category associated with the product
     *
     * @return Category
     */
    public function category()
    {
        return $this->belongsTo('Category', 'categoryId');
    }

    /**
     * Find all images for the product
     *
     * @return Image[]
     */
    public function images()
    {
        if (is_null($this->images)) {
            $this->images = Image::where('productId', '=', $this->id)->orderBy('order', 'asc')->get();
        }
        return $this->images;
    }
}