<?php
 /**
 * Simulateur de barbe - Projet d'exament AFORMAC 2019 pour Direct Webmaster - BRODAR Frederic © Tous droits réservés - 2019 
 */

$file_json = file_get_contents("jsondb.json");
$parsed_json = json_decode($file_json, true);

$servername = $parsed_json['servername'];
$username = $parsed_json['username'];
$password = $parsed_json['password'];
$dbname = $parsed_json['dbname'];


define('MYSQL_USER', $username);
define('MYSQL_PASSWORD', $password);
define('MYSQL_HOST', $servername);
define('MYSQL_DATABASE', $dbname);

$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);

$pdo = new PDO(
    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE, //DSN
    MYSQL_USER, //Username
    MYSQL_PASSWORD, //Password
    $pdoOptions //Options
);
?>
 
 
