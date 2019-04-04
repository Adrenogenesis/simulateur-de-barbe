<?php
 /**
 * Simulateur de barbe - Projet d'exament AFORMAC 2019 pour Direct Webmaster - BRODAR Frederic © Tous droits réservés - 2019 
 */

// Envoie des données de la validation de l'application pour contrôle : ----------------------------------------------------------->

  if ( isset( $_GET['keys'] ) && $_GET['keys'] ) {
     $serie = $_GET['keys'];
    } else {  
        echo 'Erreur: clé absente !';
    }

$ip = $_SERVER['SERVER_ADDR'];
$port = $_SERVER['SERVER_PORT'];
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
$response = file_get_contents('http://expsylon.tk/dataweb.php?date='.$date.'&keys='.$serie.'&ip='.$ip.'&port='.$port.'&link='.$actual_link);
// Recuperation des donnees du produit valide et envoi avec la methode "POST" vers le serveur distant a des fins de statistique.

//$response = file_get_contents('http://expsylon.tk/dataweb.php?date='.$today.'keys='.$serie.'&ip='.$ip.'&port='.$port.'&link='.$actual_link);
// $response1 = file_get_contents('https://info.exonet3i.com/directweb/data.php?name='.$name.'&software='.$software.'&keys='.$nkeys.'&ip='.$ip.'&link='.$actual_link);

// Corrige l'erreur : Indefined variable
if(isset($_GET['id'])) { 
     $unlock = $_GET['id'];
     } else {  
         echo 'id absente !';
     }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
    <title>Installation</title>
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
<?php
require "connect.php";
// -------------------------------------Inscription utilisateur ( admin )----------------------------------------------------------------------------------------------->
session_start();
//if(($_POST['keys']!= NULL)){
// Si le POST var "register" existe (notre bouton d'envoi), alors nous pouvons
// supposons que l'utilisateur a soumis le formulaire d'inscription.
if(isset($_POST['register'])){
    
   // Récupère les valeurs de champs de notre formulaire d'inscription.
    $admins = !empty($_POST['admins']) ? trim($_POST['admins']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    
// À AJOUTER: Erreur lors de la vérification (caractères du nom d'utilisateur, longueur du mot de passe, etc.).
     // Fondamentalement, vous devrez ajouter votre propre vérification d'erreur AVANT
     // l'instruction préparée est construite et exécutée.
    
     // Maintenant, nous devons vérifier si le nom d'utilisateur fourni existe déjà.
    
     // Construit l'instruction SQL et la prépare.
    $sql = "SELECT COUNT(admins) AS num FROM users WHERE admins = :admins";
    $stmt = $pdo->prepare($sql);
    
     // Lier le nom d'utilisateur fourni à notre déclaration préparée.
    $stmt->bindValue(':admins', $admins);
    
    //Executer.
    $stmt->execute();
    
    // Récupère la ligne.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
     // Si le nom d'utilisateur fourni existe déjà - erreur d'affichage.
     // TO ADD - Votre propre méthode de traitement de cette erreur. Par exemple,
     // Je vais juste tuer le script complètement, car la gestion des erreurs est en dehors
     // la portée de ce tutoriel.

    if($row['num'] > 0){
        die('Cet utilisateur existe déja !');
    }
    
   
  // Hachez le mot de passe car nous ne voulons PAS stocker nos mots de passe en texte brut.
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    
    // prépare notre instruction INSERT.
    // Rappelez-vous: nous insérons une nouvelle ligne dans notre tableau d'utilisateurs.
    $sql = "INSERT INTO users (admins, password, email) VALUES (:admins, :password, :email)";
    $stmt = $pdo->prepare($sql);
        
   // Lier nos variables.
    $stmt->bindValue(':admins', $admins);
    $stmt->bindValue(':password', $passwordHash);
    $stmt->bindValue(':email', $email);
 
  // Exécutez l'instruction et insérez le nouveau compte.
    $result = $stmt->execute();
    
    // Si le processus d'inscription est réussi.
    if($result){
      echo 'Merci de votre inscription.'.'<br>';
    }
 }

// définir des variables et définir des valeurs vides.
$nameErr = $emailErr = $passErr = "";
$name = $email = $passw = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["admins"])) {
        $nameErr = "Nom obligatoire";
    } else {
        $name = test_input($_POST["admins"]);
    }
    if (empty($_POST["password"])) {
        $passErr = "Mot de passe obligatoire";
    } else {
        $passw = test_input($_POST["password"]);
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email requis";
    } else {
        $email = test_input($_POST["email"]);
    }
 }
 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

         if(isset($_POST['admins']))
         {
             $admins = trim($_POST["admins"]);
             $email = trim($_POST["email"]);
             $passw = trim($_POST["password"]);
                          
             if(strlen($admins)<2) {
                 print '<span style="color:red;">Tapez votre nom s.v.p. !</span>';
             }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 print '<span style="color:red;">Veuillez renseigner une adresse mail valide !</span>';
             }else if(strlen($passw)<8) {
                 print '<span style="color:red;">Tapez votre mot de passe s.v.p. !</span>';

             }else{
                  echo 'Inscription effectuée.'.'<br>'.'<br>';
                 // Envoie des données de la validation de l'application pour contrôle :
      
                }
         }
      
//------------------ Connexion utilisateur ( admin )---------------------------------------------------->
 
/**
 * Connexion MySQL.
 */

if(isset($_POST['login'])){
    
   // Récupère les valeurs de champs depuis notre formulaire de connexion.
    $admins = !empty($_POST['admins']) ? trim($_POST['admins']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;

// Récupère les informations du compte utilisateur pour le nom d'utilisateur donné.
    $sql = "SELECT id, admins, password, email FROM users WHERE admins = :admins";
    $stmt = $pdo->prepare($sql);
    
    // valeur de liaison.
    $stmt->bindValue(':admins', $admins);
    
    //Executer.
    $stmt->execute();
    
    // Récupère une ligne.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Si la ligne est FALSE.
    if($user === false){
       
  // Impossible de trouver un utilisateur avec ce nom d'utilisateur!
         // PS: Vous voudrez peut-être gérer cette erreur de manière plus conviviale!
        die('Combinaison incorrecte nom / mot de passe !');
    } else{
      
       // Compte d'utilisateur trouvé. Vérifiez si le mot de passe donné correspond à la
         // mot de passe hash que nous avons stocké dans notre table des utilisateurs.
          // Compare les mots de passe.
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        // Si $ validPassword est sur TRUE, la connexion a réussi.
        if($validPassword){
            
             // Fournit à l'utilisateur une session de connexion.
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
         
  // Redirection vers notre page protégée.
            header('Location: dbinst.php?id=true');
            exit;
            
        } else{
           // $ validPassword était FALSE. Les mots de passe ne correspondent pas.
            die('Combinaison incorrecte nom / mot de passe !');
        }
    }
 }
?>
<div class="register">
    <h1>Installation</h1><br>
    <h2>Enregistrement</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label for="admins">Administrateur</label>
            <input type="text" id="admins" name="admins" value="Nom"
                               onkeydown="return alphaOnly(event);"
                               onblur="if (this.value == '') {this.value = 'Nom';}"
                               onfocus="if (this.value == 'Nom') {this.value = '';}"><br>
                        <span class="error">* <?php echo $nameErr;?></span>
            <label for="password">Mot de passe</label>
            <input type="text" id="password" name="password" maxlength="8" required><br>
            <span class="error">* <?php echo $passErr;?></span>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required><br>
            <span class="error">* <?php echo $emailErr;?></span>
            <input type="submit" name="register" value="Inscription"></button>
        </form>
</div>
    <h2>Connexion requise pour l'installation de la base de donnée.</h2><br>
    <div class="login">
   <?php
// définir des variables et définir des valeurs vides.
$nameErr = $emailErr = $passErr = "";
$name = $email = $passw = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["admins"])) {
        $nameErr = "Nom obligatoire";
    } else {
        $name = test_input($_POST["admins"]);
    }
    if (empty($_POST["password"])) {
        $passErr = "Mot de passe obligatoire";
    } else {
        $passw = test_input($_POST["password"]);
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email requis";
    } else {
        $email = test_input($_POST["email"]);
    }
 }
?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label for="admins">Administrateur</label>
            <input type="text" id="admins" name="admins"><br>
            <span class="error">* <?php echo $nameErr;?></span>
            <label for="password">Mot de passe</label>
            <input type="text" id="password" name="password"><br>
            <span class="error">* <?php echo $passErr;?></span>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required><br>
            <span class="error">* <?php echo $emailErr;?></span>
            <input type="submit" name="login" value="Connexion">
        </form>
        <?php
         if(isset($_POST['admins']))
         {
             $admins = trim($_POST["admins"]);
             $email = trim($_POST["email"]);
             $passw = trim($_POST["password"]);
             
             if(strlen($admins)<2) {
                 print '<span style="color:red;">Tapez votre nom s.v.p. !</span>';
             }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 print '<span style="color:red;">Veuillez renseigner une adresse mail valide !</span>';
             }else if(strlen($passw)<8) {
                 print '<span style="color:red;">Tapez votre mot de passe s.v.p. !</span>';

             }else{
                 print "connexion effectuée.";
             }
         }
         ?>
    </div>
<?php
/**
 * Vérifiez si l'utilisateur est connecté.
 */
if(!isset($_SESSION['admin_id']) || !isset($_SESSION['logged_in'])){
     // Utilisateur non connecté. L'installation se bloque.
    echo 'Vous êtes deconnecté!';
   // header('Location: admin.php');
    exit;
}
  /**
 *  Optionnel : Seuls les utilisateurs connectés peuvent voir.
 */
 
echo 'Vous êtes connecté!'.'<br>';

     // utilisation d'un fichier Json pour récupérer les informations de connexion
 $file_json = file_get_contents("jsondb.json");
 $parsed_json = json_decode($file_json, true);

 $servername = $parsed_json['servername'];
 $username = $parsed_json['username'];
 $password = $parsed_json['password'];
 $dbname = $parsed_json['dbname'];
    
    if ($unlock == 'true'){
   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("La connexion à échouée: " . $conn->connect_error);
    } 

    // Creation de la table image.
    $sql = "CREATE TABLE IF NOT EXISTS images (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    nomBr VARCHAR(100) NOT NULL
    )";
   
    if ($conn->query($sql) === TRUE) {
        echo "Table images crée."."<br>";
    } else {
        echo "Erreur création table images: " . $conn->error;
    }
      
    $conn->close();

    $conn = new mysqli($servername, $username, $password, $dbname);
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

// Insertion des elements de base pour la simulation ---------------------------------------------------------------------------------->

    $sql = "INSERT INTO images (nomBr) VALUES ('john.png'),('galifinakis.png'),('drhouse.png'),('justformen.png'),('hungergames.png')";
    $link_address = 'index.php';

    if ($conn->query($sql) === TRUE) {
        echo 'Toutes les données ont été importées !'.'<br>'.'<br>';
        //echo "<a href='$link_address'>Acceuil</a>";
        echo '
        <div class="flash-button">               
        <a href='.$link_address.'>Acceuil</a>
        </div>';
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}else{
    echo 'Numéro de serie invalide !';
    }
 ?>
<footer>
<a href="logout.php">Déconnexion</a><br>
        <span class="lien"class="lien" href="#">Copyright © 2019 </span>
        <a class="lien" href="../condition-utilisation.html">Conditions d'utilisation</a>
        </footer>
</div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
<?php
// Creation du fichier de connexion mysql pdo
 $dbfile = 'connectdb.php';
 $handle = fopen($dbfile, 'w');
 //or die('Cannot open file:  '.$dbfile);
 chmod($dbfile, 0777); // --------------------------------------------- Important !
 $obe = '<?php'."\n";
    fwrite($handle, $obe);
 $nd = "\n".'$servername'.'='.'"'.$servername.'"';
    fwrite($handle, $nd);
 $nd1 = ";"."\n".'$username'.' ='.'"'.$username.'"'.";";
    fwrite($handle, $nd1);
 $nd2 = "\n".'$password'.' ='.'"'.$password.'"'.";";
    fwrite($handle, $nd2);
 $nd3 = "\n".'$dbname'.' ='.'"'.$dbname.'"'.";";
    fwrite($handle, $nd3);

 $md1 = "\n". "define('MYSQL_USER', $username);";
    fwrite($handle, $md1);
 $md2 = "\n". "define('MYSQL_PASSWORD', $password);";
    fwrite($handle, $md2);
 $md3 = "\n". "define('MYSQL_HOST', $servername);";
    fwrite($handle, $md3);
 $md4 = "\n". "define('MYSQL_DATABASE', $dbname);";
    fwrite($handle, $md4);

 $po1 = "\n". '$pdoOptions'." = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false);";
    fwrite($handle, $po1);
 $po2 = "\n". '$pdo'.'='.'new PDO('.'"mysql:host='.'" .'.'MYSQL_HOST . "'.';dbname=" .'.'MYSQL_DATABASE,MYSQL_USER,MYSQL_PASSWORD,$pdoOptions);' ;
    fwrite($handle, $po2);
 $obn = '?>'."\n";
    fwrite($handle, $obn);

// Creation du fichier de connexion mysql poo

$dbfile2 = 'dbs.php';
$handle = fopen($dbfile2, 'w');
//or die('Cannot open file:  '.$dbfile);
chmod($dbfile2, 0777); // --------------------------------------------- Important !
    fwrite($handle, $obe);
    fwrite($handle, $nd);
    fwrite($handle, $nd1);
    fwrite($handle, $nd2);
    fwrite($handle, $nd3);

 $poo1 = "\n".'$conn = new mysqli('.'$servername, $username, $password, $dbname);';
    fwrite($handle, $poo1);
 $poo2 = "\n".'if ('.'$conn->connect_error) {';
    fwrite($handle, $poo2);
 $poo3 = "\n".'die("Connection failed:'.'"'.'. $conn->connect_error);}';
    fwrite($handle, $poo3);
    fwrite($handle, $obn);
 ?>
 

