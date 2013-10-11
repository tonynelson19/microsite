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
class User extends Eloquent implements Illuminate\Auth\UserInterface
{
	protected $table = 'users';

    public $timestamps = false;

    public function getAuthIdentifier()
    {
        return $this->username;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Find a user by username
     *
     * @param string $username
     * @return User
     */
    public static function findByUsername($username)
    {
        return self::where('username', '=', $username)->get()->first();
    }
}