<?php
namespace Models\Users;

use Services\Db;

class UserActivationService
{
    private const TABLE_NAME = 'users_activation_codes';

    public static function createActivationCode(User $user) : string
    {
        $code = bin2hex(random_bytes(16));
        $db = DB::getInstace();
        $db->Query(
            "INSERT INTO " . self::TABLE_NAME . " (user_id,code) VALUES (:user_id,:code)",
            ["user_id"=>$user->getId(), "code"=>$code]
        );

        return $code;
    }

    public static function checkActivationCode(User $user, string $code) : bool
    {
        $db = DB::getInstace();
        $result = $db->Query(
            "SELECT * FROM " . self::TABLE_NAME . " WHERE user_id=:user_id AND code=:code",
            ["user_id"=>$user->getId(), "code"=>$code]
        );

        return !empty($result);
    }
}


?>