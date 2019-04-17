<?php
session_start();
 /**
 * Simulateur de barbe - Projet d'exament AFORMAC 2019 pour Direct Webmaster - BRODAR Frederic © Tous droits réservés - 2019 
 */

/**
 * Suppression des fichiers d'installation inutiles.
 */
 $fichierjson="jsondb.json";
 $connfile1="connect.php";
 $connfile2="db.php";

 chmod('0777',$connfile1); // Important !
 chmod('0777',$connfile2);

 unlink($fichierjson);
 unlink($connfile1);
 unlink($connfile2);

// Il se peut que sur certains serveur le procede ne marche pas, le fichier est alors toujours present. 

function fileExist($connfile1,$connfile2){

  $connfile1 = 'connect.php';
  $connfile2 = 'connectdb.php';

    if (file_exists($connfile1)) {
         return $connfile1;
    }else if(file_exists($connfile2)){
         return $connfile2;
    } else {
     echo 'Erreur ! Les fichiers de configuration de la BDD sont absents !'.'<br>';
     echo 'L\'installation à echouée !';
   }
}
//dirname("/BDD") . PHP_EOL;
$connfx = fileExist($connfile1,$connfile2);
//echo $connfx;

require $connfx;

// Connexion administrateur ------------------------------------------------>  
if(isset($_POST['login'])){
        
    $admins = !empty($_POST['admins']) ? trim($_POST['admins']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    
    $sql = "SELECT id, admins, password, email FROM users WHERE admins = :admins";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindValue(':admins', $admins);
    $stmt->execute();
   
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
     
    if($user === false){
          die('Combinaison incorrecte nom / mot de passe !');
    } else{
          $validPassword = password_verify($passwordAttempt, $user['password']);
           
        if($validPassword){
                      
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
                  
            header('Location: admin.php');
            exit;
            
        } else{
             die('Combinaison incorrecte nom / mot de passe !');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
    <title>Administrateur</title>
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
        <div class="login">
        <h2>Connexion administrateur</h2>
  <!------------- Entree des identifiants de connexion ---------------------------------------------------------->
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="row">
      <div class="col-25">
      <label for="admins">Administrateur</label>
      </div>
      <div class="col-75">
      <input type="text" id="admins" name="admins">
             </div>
    </div>
    <div class="row">
      <div class="col-25">
      <label for="password">Mot de passe</label>
      </div>
      <div class="col-75">
      <input type="text" id="password" name="password">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
      <label for="email">Email</label>
      </div>
      <div class="col-75">
      <input type="email" id="email" name="email" required><br>
             </div>
    </div>
    <div class="row">
    <div class="col-25">
    <input type="submit" name="login" value="Connexion"><br>
    
    </div>
    </div>
    </div>
  </form>
  
  <!------------- Integration du formulaire de telechargement ---------------------------------------------------------->
  <div class="upload">
  <?php include 'upload.php';?>
</div>
<footer>
<a href="index.php">Acceuil</a><br>
  <?php
//Efface les fichiers dans le dossier ('upload/');

$folder = '../upload';
 
// Obtient une liste de tous les noms de fichiers du dossier.
$files = glob($folder . '/*');
 
// Boucle dans la liste de fichiers.
foreach($files as $file){
     // Assurez-vous qu'il s'agit d'un fichier et non d'un répertoire.
    if(is_file($file)){
         // Utilisez la fonction unlink pour supprimer le fichier.
        unlink($file);
    }
}
?>
<span class="warn">
<p>Tout les fichiers inutiles ont été supprimé !</p></span>
        <a href="logout.php">Déconnexion</a><br><br>
			<span class="lien"class="lien" href="#">Copyright © 2019 </span>
            </footer>
</div>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>