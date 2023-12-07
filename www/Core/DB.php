<?php

namespace App\Core;

use \PDO;
use \Exception;
use ReflectionClass;
use ReflectionProperty;

class DB
{
    protected $bdd;
    public string $table;

    public function __construct()
    {
        try {
            $this->bdd = new PDO("pgsql:host=db;port=5432;dbname=foliomakerdb", "foliomakeruser", "foliomakerpsw");
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function save(): void
    {
        $model = get_called_class();
        $reflection = new ReflectionClass($model);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);

        $modelProperties = [];

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $methodName = 'get' . ucfirst($propertyName);

            if ($propertyName === 'isDeleted') {
                $modelProperties[$propertyName] = $this->$methodName() ? '1' : '0';
                continue;
            }

            $value = $this->$methodName();

            if (is_string($value)) {
                $value = "'" . str_replace("'", "''", $value) . "'";
            }

            $modelProperties[$propertyName] = $value;
        }

        $table = $this->getTableName();
        $columns = implode(", ", array_keys($modelProperties));
        $values = implode(", ", array_values($modelProperties));
        $id = $modelProperties['id'] == 0 ? 0 : $modelProperties['id'];

        if ($id === 0) {
            $q = "INSERT INTO $table ($columns) VALUES ($values)";
        } else {
            $fielsUpdate = [];
            foreach ($modelProperties as $key => $value) {
                if ($key === 'id') {
                    continue;
                }

                $fielsUpdate[] = "$key = $value";
            }
            $q = "". implode(", ", $fielsUpdate) . "";
            $q = "UPDATE $table SET $q WHERE id = $id";
        }

        $req = $this->bdd->prepare($q);

        if (!$req->execute()) {
            $errorInfo = $req->errorInfo();
            echo "Erreur SQL: {$errorInfo[2]}";
        }
    }

    protected function getTableName(): string
    {
        $table = get_called_class();
        // $table = "esgi_" . $table; PREFIX
        return strtolower(str_replace("App\\Models\\", "", $table));
    }

}
