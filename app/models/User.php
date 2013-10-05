<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * User model
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $salt
 */
class User extends Eloquent
{
	protected $table = 'users';

    public $timestamps = false;
}