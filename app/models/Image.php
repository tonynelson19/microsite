<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Image model
 *
 * @property int $id
 * @property int $productId
 * @property string $caption
 * @property string $image
 * @property int $order
 */
class Image extends Eloquent
{
	protected $table = 'images';

    public $timestamps = false;
}