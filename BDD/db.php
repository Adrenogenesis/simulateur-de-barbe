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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
echo "Connexion réussie avec succès."."<br>";
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
