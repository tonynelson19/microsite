<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Section model
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $order
 */
class Section extends Eloquent
{
	protected $table = 'sections';

    public $timestamps = false;

    /**
     * Categories
     *
     * @var Category[]
     */
    protected $categories;

    /**
     * Find all categories for the section
     *
     * @return Category[]
     */
    public function categories()
    {
        if (is_null($this->categories)) {
            $this->categories = Category::where('sectionId', '=', $this->id)->orderBy('order', 'asc')->get();
        }
        return $this->categories;
    }
}