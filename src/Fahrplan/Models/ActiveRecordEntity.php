<?php

namespace Fahrplan\Models;

use Fahrplan\Services\Db;

abstract class ActiveRecordEntity
{
    /** @var string */
    protected $id;

    public function __set($name, $value){
        $name = ActiveRecordEntity::underscoreToCamelCase($name);
        $this->$name = $value;
    }
    public function getId(): string
    {
        return $this->id;
    }

    public function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    /**
     * @return static[]
     */
    public static function findAll(): array
    {
        $db = $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }


    public static function getById(string $id): ?self
    {
        $db = $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    public function save(string $type): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($type == 'update') {
            $this->update($mappedProperties);
        } else {
            //print_r($mappedProperties);
            $this->insert($mappedProperties);
        }
    }

    public function delete(): void
    {
        $db = Db::getInstance();
        $db->query(
            'DELETE FROM `' . static::getTableName() . '` WHERE id = :id',
            [':id' => $this->id]
        );
        $this->id = null;
    }

    abstract protected static function getTableName(): string;

    private function update(array $mappedProperties): void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index; // :param1
            $columns2params[] = ActiveRecordEntity::camelCaseToUnderscore($column) . " = '" . $value . "'"; // column1 = :param1
            $params2values[$param] = $value; // [:param1 => value1]
            $index++;
        }
        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = "' . $this->id . '"';
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    private function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);

        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach ($filteredProperties as $columnName => $value) {
            $columns[] = '`' . ActiveRecordEntity::camelCaseToUnderscore($columnName) . '`';
            $paramName = ':' . ActiveRecordEntity::camelCaseToUnderscore($columnName);
            $paramsNames[] = $paramName;
            $paramName = $paramName;
            $params2values[$paramName] = $value;
        }
        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);


        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInsertId();
    }

    private function refresh(): void
    {
        $objectFromDb = static::getById($this->id);
        $reflector = new \ReflectionObject($objectFromDb);
        $properties = $reflector->getProperties();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $this->$propertyName = $property->getValue($objectFromDb);
        }
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $mappedProperties[$property->getName()] = $this->$propertyName;
        }
        return $mappedProperties;
    }

    public function setId(string $id):void
    {
        $this->id = $id;
    }

    public function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
            [':value' => $value],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result[0];
    }
}
