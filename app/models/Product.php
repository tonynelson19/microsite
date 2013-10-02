<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';
}