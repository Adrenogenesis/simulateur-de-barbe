<?php
 /**
 * Simulateur de barbe - Projet d'exament AFORMAC 2019 pour Direct Webmaster - BRODAR Frederic © Tous droits réservés - 2019 
 */

//--- Cela marche chez moi : VPS en acces root. -- utilisateur : www-data ---->
// Creation du fichier de configuration BDD.
 $fichierjson = 'jsondb.json';

if(isset($_GET['json'])) { 
    $data = $_GET['json'];
    } else {  
        echo '!';
    }
    echo "json  : ".$_GET['json']."<br>";

    $fh = fopen($fichierjson, 'w');
    chmod($fichierjson, 0777); // Droit en ecriture activee.
fwrite($fh, $data);
fclose($fh);
?>
<!DOCTYPE html>
<html lang="fr" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Database configuration.</title>
        <link rel="stylesheet" href="../css/loader.css">
</head>
<body>
<div class="text">
  Création du fichier de configuration mysql en cours...
</div>

<div class="box">
  <div class="comp"></div>
  <div class="loader"></div>
  <div class="con"></div>
  <div class="byte"></div>
  <div class="circle"></div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
</body>
</html>
<script>
  //------------- Redirection pour l'installation ( Configuration de la BDD ) -------------------------------------------------->
     setTimeout(function () {
       window.location.href = "validate.php"; 
    }, 5000); // Appellera la fonction après 5 secondes.
</script>