<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $salt
 *
 */
class User extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
}