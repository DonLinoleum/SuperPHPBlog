<?php
namespace Services;

use Exceptions\DBException;
use PDO,PDOException;




class Db
{
    private $pdo;
    private static $instance;

    public static function getInstace() : static
    {
        if (self::$instance === null)
        {
            return self::$instance = new static(); 
        }
        return self::$instance;
    }

    private function __construct()
    {
        $dbOptions = (require __DIR__ . "/../Connect.php")['db'];
        try
        {          
            $this->pdo = new PDO("mysql:host={$dbOptions['host']};dbname={$dbOptions['dbname']}",
            $dbOptions['name'],
            $dbOptions['password']);
            
        }
        catch(PDOException $e)
        {
            throw new DBException("Пук" . $e->getMessage());
        }
      
    }
    public function Query (string $sql, array $params=[], string $className = "stdClass" ) : ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        
        if (false === $result) 
        {
            return null;
        }

        return $sth->fetchAll(PDO::FETCH_CLASS,$className);

    }
    public function getLastInsertId() : int
    {
        return $this->pdo->lastInsertId();
    }
    
}

?>