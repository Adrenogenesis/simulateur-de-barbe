<?php
 /**
 * Simulateur de barbe - Projet d'exament AFORMAC 2019 pour Direct Webmaster - BRODAR Frederic © Tous droits réservés - 2019 
 */

require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();
     // Set the hosts

if ($client) {
	echo 'connected';
}

// Directweb  ----------------->
date_default_timezone_set('UTC');
$date = date("Y-m-d H:i:s");
  
  if ( isset( $_GET['date'] ) && $_GET['date'] ) {
     # do description lookup and 'echo' it out:
     $client = $_GET['date'];
     echo $date;
   }
  
  if ( isset( $_GET['keys'] ) && $_GET['keys'] ) {
    # do description lookup and 'echo' it out:
    $serie = $_GET['keys'];
    echo $serie;
  }
  
  if ( isset( $_GET['ip'] ) && $_GET['ip'] ) {
      # do description lookup and 'echo' it out:
      $ip = $_GET['ip'];
      echo $ip;
   }
  
   if ( isset( $_GET['port'] ) && $_GET['port'] ) {
    # do description lookup and 'echo' it out:
    $port = $_GET['port'];
    echo $port;
 }

    if ( isset( $_GET['link'] ) && $_GET['link'] ) {
      # do description lookup and 'echo' it out:
      $link = $_GET['link'];
      echo $link;
   }
  
   
  $min=1000; 
  $max=9000;  
  //echo rand($min,$max);
  $id = rand($min,$max);
  

$params = array();
$params['body']  = array(
  'date' => $date,
  'keys' => $serie,
  'ip' => $ip,
  'port' => $port,
  'link' => $link 
);

$params['index'] = 'dataweb-7';
$params['type']  = 'data';
$params['id'] = $id;

$result = $client->index($params);

?>


