<?php


namespace app\models;


use app\core\Model;

class UserRepository extends Model
{
    protected const TABLE = 'users';

    public static function validate(string $userName, string $password): bool
    {
        $user = self::findByName($userName);
        if ($user) {
            return password_verify($password, $user->password);
        }
        return false;
    }
}