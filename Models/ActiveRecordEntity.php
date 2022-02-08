<?php
namespace Models;

use Reflection;
use ReflectionObject;

abstract class ActiveRecordEntity
{
    protected $id;

    public function getId()
    {
        return $this->id;
    }
    
    public function __set($name, $value)
    {
        
        $camelCaseName = $this->toCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function toCamelCase(string $item) : string
    {
        return lcfirst(str_replace("_","",ucwords($item,"_")));
    }

    public static function findAll() : array
    {
        $db = \Services\Db::getInstace();
        return $db->Query('SELECT * FROM ' . static::getTableName(),[],static::class);
    }

    public static function getById(int $id) : ?static
    {
        $db = \Services\Db::getInstace();
        $entities = $db->Query("SELECT * FROM `" . static::getTableName() . "` WHERE id = :id",[':id'=>$id],static::class);
        return $entities ? $entities[0] : null;
    }

    static protected abstract function getTableName(): string;

    public function camelCaseToUnderscore($item): string
    {
        return strtolower(preg_replace("/(?<!^)[A-Z]/","_$0",$item));
    }

    public function mapPropertiesToDbFormat() 
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $mapped = [];

        foreach($properties as $property)
        {
            $propertyName = $property->getName();
            $mapedProperty = $this->camelCaseToUnderscore($propertyName);
            $mapped[$mapedProperty] = $this->$propertyName;
        }
        
        return $mapped;
    }

    public function save()
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null)
        {
            $this->update($mappedProperties);
        }
        else 
        {
          $this->insert($mappedProperties);
        }
    }
    public function update(array $mappedProperties) : void
    {
        $columns2Params = [];
        $columns2Values = [];
        $index = 1;
        foreach($mappedProperties as $columns=>$values)
        {
            $param = ":param" . $index;
            $columns2Params[] = $columns . " = " . $param;
            $columns2Values[$param] = $values;  
            $index++;
        }
       
        $sql = "UPDATE " . static::getTableName() . " SET " . implode( " , ",$columns2Params) . " WHERE id = " . $this->id;
        $db = \Services\Db::getInstace();
        $db->Query($sql,$columns2Values,static::class);
    }

    public function insert(array $mappedProperties) : void
    {
        $filteredProperties = array_filter($mappedProperties,fn($item)=>$item!==null);
        $columns = [];
        $paramNames = [];
        $param2Values = [];

        foreach($filteredProperties as $columnName=>$value)
        {
            $columns[] = "`" . $columnName . "`";
            $paramName = ":" . $columnName;
            $paramNames[] = ":" . $columnName;
            $param2Values[$paramName] = $value;
        }
        $sql = "INSERT INTO " . static::getTableName() . " (" . implode(",",$columns) . ") VALUES (". implode(",",$paramNames) .");";
        $db = \Services\Db::getInstace();
        $db->Query($sql,$param2Values,static::class);
        $this->id = $db->getLastInsertId();
        $this->refresh();        
    }

    public function refresh() : void
    {
        $objectFromDb = static::getById($this->id);
        $reflector = new ReflectionObject($objectFromDb);
        $properties = $reflector->getProperties();

        foreach ($properties as $property)
        {
            $name = $property->getName();
            $value = $property->getValue($objectFromDb);
            $this->$name = $value;
        }
    }

    public function delete ($id)
    {
        $sql = "DELETE FROM " . static::getTableName() . " WHERE id = :id;";
        $db = \Services\Db::getInstace();
        
       $db->Query($sql,[":id"=>$id],static::class);
        $this->id = null;
    }
     
}



?>