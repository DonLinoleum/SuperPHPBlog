<?php
namespace Models\Users;
class User extends \Models\ActiveRecordEntity
{
    protected $nickname;
    protected $email;
    protected $isConfirmed;
    protected $role;
    protected $passwordHash;
    protected $authToken;
    protected $createdAt;

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getNickName() : string
    {
        return $this->nickname;
    }

    static protected  function getTableName() : string
    {
        return 'users';
    }
}


?>