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
        // Récupérer les propriétés de l'objet
        $model = get_called_class();
        $reflection = new ReflectionClass($model);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);

        $modelProperties = [];

        foreach ($properties as $property) {

            // Récupérer le nom de la propriété
            $propertyName = $property->getName();
            // Appeler la méthode get correspondante
            $methodName = 'get' . ucfirst($propertyName);

            if ($propertyName === 'isDeleted') {
                $modelProperties[$propertyName] = $this->$methodName() ? '1' : '0';
                continue;
            }

            // Récupérer la valeur de la propriété
            $value = $this->$methodName();

            // Si la valeur est une chaîne de caractères, on l'entoure de quotes
            if (is_string($value)) {
                $value = "'" . str_replace("'", "''", $value) . "'";
            }

            // Ajouter la propriété et sa valeur au tableau
            $modelProperties[$propertyName] = $value;
        }

        // Si l'id est à 0, c'est qu'il s'agit d'une insertion
        // Donc on supprime l'id du tableau et on set une variable id à 0
        // Sinon, on set la variable id à la valeur de l'id de l'objet
        if ($modelProperties['id'] == 0) {
            unset($modelProperties['id']);
            $id = 0;
        } else {
            $id = $modelProperties['id'];
        }

        // On récupère le nom de la table
        $table = $this->getTableName();
        // On récupère les colonnes et les valeurs
        $columns = implode(", ", array_keys($modelProperties));
        $values = implode(", ", array_values($modelProperties));

        // On construit la requête SQL
        // Si id = 0, c'est un INSERT
        // Sinon, c'est un UPDATE
        if ($id == 0) {
            $q = "INSERT INTO $table ($columns) VALUES ($values)";
        } else {
            $fielsUpdate = [];
            // On construit le tableau des champs à mettre à jour
            // On boucle sur les propriétés de l'objet
            foreach ($modelProperties as $key => $value) {
                if ($key === 'id') {
                    continue;
                }

                // On construit le tableau des champs à mettre à jour
                $fielsUpdate[] = "$key = $value";
            }
            $q = "UPDATE $table SET " . implode(", ", $fielsUpdate) . " WHERE id = $id";
        }

        // On exécute la requête
        $req = $this->bdd->prepare($q);

        if (!$req->execute()) {
            $errorInfo = $req->errorInfo();
            echo "Erreur SQL: {$errorInfo[2]}";
        }
    }

    // Fonction pour récupérer le nom de la table
    protected function getTableName(): string
    {
        $table = get_called_class();
        // $table = "esgi_" . $table; PREFIX
        return strtolower(str_replace("App\\Models\\", "", $table));
    }

}
