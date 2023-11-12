<?php 
$host = 'db';
$database = 'foliomakerdb';
$username = 'foliomakeruser';
$password = 'foliomakerpsw';

try {
    $bdd = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
