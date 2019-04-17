<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
    <title>Validation</title>
    <meta name="keywords" content="simulateur, barbe, simulateur de barbe, webcam, direct webmaster, webmaster, développeur, développeur web, aformac">
    <meta name="author" content="Brodar Frédéric">
    <meta name="publisher" content="Brodar Frédéric">
    <meta name="language" content="fr" >
    <meta name="distribution" content="global" >
    <meta name="expires" content="never">
    <meta name="Robots" content="index, follow">
    <link rel="author" href="dcl.fredb@18pixel.fr">
    <meta name="copyright" content="BRODAR-2019">
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:title" content="Simulateur de barbe"/>
    <meta property="og:description" content="Simulateur de barbe"/>
    <meta property="og:url" content="https://info.exonet3i.com/directweb/">
    <meta property="og:site_name" content="dcl.pfcv.18pixel" />
    <meta property="article:publisher" content="Brodar Frédéric" />
    <meta property="og:image" content="https://dcl.pfcv.18pixel.fr/dcl.fredb/img/brodar.jpg">
    <meta name="twitter:image:src" content="http://www.exonet3i.com/images/exonet3i.jpg">
    <meta name="twitter:domain" content="http://www.exonet3i.com/">
    <meta name="twitter:creator" content="@exonet3i">
    <meta name="twitter:image" content="http://exonet3i.com/images/exonet3i.jpg">
    <meta name="twitter:url" content="https://twitter.com/exonet3i">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Validation du produit.</h1><br>
    <span class="warn">
<h3>Important !</h3>
<p>Les droits d'accès en écriture chmod 777 doivent être appliqué au dossier : upload.</p></span>
<p>Entrez votre numéro de série.</p><br>
<h4>Logs :</h4>
<?php
 /**
 * Simulateur de barbe - Projet d'exament AFORMAC 2019 pour Direct Webmaster - BRODAR Frederic © Tous droits réservés - 2019 
 */

 // utilisation d'un fichier Json pour récupérer les informations de connexion
 // jsondb.json sera supprime par le suite, pour des raisons de securite.

 $file_json = file_get_contents("jsondb.json");
 $parsed_json = json_decode($file_json, true);

 $servername = $parsed_json['servername'];
 $username = $parsed_json['username'];
 $password = $parsed_json['password'];
 
// Creation de la connexion
$conn = new mysqli($servername, $username, $password);
 // Controle de la connexion
if ($conn->connect_error) {
die("La connexion à échouée: " . $conn->connect_error);
} 
$dbname = $parsed_json['dbname'];
// Creation de la base de donnee "DBName"
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";

if ($conn->query($sql) === TRUE) {
    echo 'Base de donnée crée !'.'<br>';
} else {
    echo "Erreur création base de donnée !: " . $conn->error;
}

$conn->close();

$file_json = file_get_contents("jsondb.json");
$parsed_json = json_decode($file_json, true);

$servername = $parsed_json['servername'];
$username = $parsed_json['username'];
$password = $parsed_json['password'];
$dbname = $parsed_json['dbname'];

// Creation de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("La connexion à échouée: " . $conn->connect_error);
} 

$sql = "CREATE TABLE IF NOT EXISTS admindb (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    hostname VARCHAR(20) NOT NULL,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(60) NOT NULL,
    dbname VARCHAR(60) NOT NULL
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo 'Table admindb crée !'.'<br>';
    } else {
        echo "Erreur création table admindb: " . $conn->error;
    }

$conn->close();

$conn = new mysqli($servername, $username, $password, $dbname);
    // Controle de la connexion
    if ($conn->connect_error) {
        die("La connexion à échouée: " . $conn->connect_error);
    } 

    $sql = "INSERT INTO admindb (hostname,username,password,dbname) VALUES ('$servername','$username','$password','$dbname')"; 


    if ($conn->query($sql) === TRUE) {
        echo 'Toutes les données utilisateur de la base de donnée ont été importées !'.'<br>'.'<br>';
     } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
 ?>

<div class="keys">
   
<h4>Informations licence.</h4><br>

<?php 
// Validation du produit ------------------------------------------------------------------------------------> 

if (isset($_POST['validate'])){
$name=$_POST['client'];
$software=$_POST['software'];
$keys=$_POST['keys'];
$keyarray=explode("\r\n",$keys);
$numkeys=count($keyarray);
define ('LKM_DEBUG','Yes');
define("TSTART","<table border=\"2\"><tr><th>Nom</th><th>Software</th><th>Key</th><th>Validation</th></tr>");
define("TCLOSE","</table>");
include("license_key.class.php");
$pass=new license_key();
for($i=0;$i<$numkeys;$i++){
    $thiskey=$keyarray[$i];
    $keylen=strlen(str_replace("-","",$thiskey));
    $pass->keylen=$keylen;
    $valid=$pass->codeValidate($thiskey,$name.$software);
echo "<br/>License Key: $thiskey Length: $keylen Valid: $valid<hr/>";
$nkeys = "License Key: $thiskey, Length: $keylen, Valid: $valid";
// Si la validation a reussie alors on cree la table administrateur.
if ($valid == 'YES'){
    
    require "db.php";

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        admins VARCHAR(20) NOT NULL,
        password VARCHAR(60) NOT NULL,
        email VARCHAR(60) NOT NULL
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo 'Table users crée.'.'<br>';
        } else {
            echo "Erreur lors de la création de la table users: " . $conn->error;
        }
  
    $conn->close();

  }else{
  //echo 'Numero de serie invalide !';
  header('Location: ../install.php');
  }
}
echo "<br/><br/><a href=\"../install.php\">Recommencer</a><br/><br/>";

}else{
?>
<?php
$prodErr = $clientErr = $serieErr = "";
$prod = $client = $serie = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["software"])) {
        $prodErr = "Nom du produit obligatoire !";
    } else {
        $prod = test_input($_POST["software"]);
    }
    if (empty($_POST["client"])) {
        $clientErr = "Client obligatoire !";
    } else {
        $client = test_input($_POST["client"]);
    }
    if (empty($_POST["keys"])) {
        $serieErr = "Clé requise !";
    } else {
        $serie = test_input($_POST["keys"]);
    }
 }
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<label for="software">Nom du produit :</label>
<input type="text" id="software" name="software" required><br>
<span class="error">* <?php echo $prodErr;?></span>
<label for="client">Votre nom client :</label>
<input type="text" id="client" name="client" required><br>
<span class="error">* <?php echo $clientErr;?></span>
<label for="keys">Numéro de série :</label>
<input id="keys" name="keys" required><br>
<span class="error">* <?php echo $serieErr;?></span>
<input name="validate" type="submit" value="Soumettre"/>
</form>
<?php 
}
    if(isset($_POST['software']))
        {
            $prod = trim($_POST["software"]);
            $client = trim($_POST["client"]);
            $serie = trim($_POST["keys"]);
          
            if(strlen($prod)<2) {
                print '<span style="color:red;">Le nom du produit s.v.p. !</span>';
            }else if(strlen($client)<2) {
                print '<span style="color:red;">Votre nom client s.v.p. !</span>';

            }else{
                $link_address = 'dbinst.php?';
                echo " Validation de votre cle produit: \n".$serie."<br><br>";
                // Envoie des donnees du produit avec la methode "POST".
                //echo "<a href='".$link_address."&keys=$serie'>Terminer l'installation.</a>"."<br>";
                echo '
                <div class="flash-button">               
                <a href='.$link_address.'&keys='.$serie.'>Terminer l\'installation.</a>
                </div>';
            }
        }
?>
</div>
<footer>
     <span class="lien"class="lien" href="#">Copyright © 2019 </span>
     <a class="lien" href="../conditions-utilisation.html">Conditions d'utilisation</a>
        </footer>
</div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>