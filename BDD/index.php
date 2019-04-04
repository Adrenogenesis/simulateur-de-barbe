<?php
 /**
 * Simulateur de barbe - Projet d'exament AFORMAC 2019 pour Direct Webmaster - BRODAR Frederic © Tous droits réservés - 2019 
 */

function fileExist($connfile1,$connfile2){

   $connfile1 = 'connect.php';
   $connfile2 = 'connectdb.php';

     if (file_exists($connfile1)) {
          return $connfile1;
     }else if(file_exists($connfile2)){
          return $connfile2;
     } else {
      echo 'Erreur ! Les fichiers de configuration de la BDD sont absents !'.'<br>';
      echo 'installation a echouée !';
    }
}
//dirname("/BDD") . PHP_EOL;
 $connfx = fileExist($connfile1,$connfile2);
 //echo $connfx;

require $connfx;

// Corrige l'erreur : Indefined variable
$img = "";
$img = isset($_POST['image']) ? $_POST['image'] : ''; 
$folderPath = "../upload/";
// Charge les captures sur le canvas
$image_parts = explode(";base64,", $img);
$image_type_aux = explode("image/", $image_parts[0]);
if ( ! isset($image_type_aux[1])) {
  $image_type_aux[1] = null;
}
$image_type = $image_type_aux[1];
if ( ! isset($image_parts[1])) {
  $image_parts[1] = null;
}
$image_base64 = base64_decode($image_parts[1]);
$fileName = uniqid() . '.png';
$file = $folderPath . $fileName;
file_put_contents($file, $image_base64);
//print_r($fileName);

// Requete sql pour le selecteur de barbe. Voir admin.php.

   $sth = $pdo->prepare("SELECT nomBr FROM images");
   $sth->execute();
   
   /* Récupération de toutes les valeurs de la première colonne */
   $result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
   //var_dump($result);
// json encode pour le selecteur avec phpArray
   $json = json_encode($result);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
    <title>Simulateur de barbes</title>
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

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  </head>
<body>
<div class="container">
  <!--------------- Calque de positionnement ----------------------------------------->
<div id="overlay" onclick="off()">
                 <div id="text"><img src="../images/face.png" alt="Smiley face" height="280" width="230">
                 <div class="text2">
                 Positionner votre visage au centre du dessin.</div>
                 </div>
                 </div>
     <h1 class="text-center">Simulateur de barbes</h1><br>
      <form method="POST" action="index.php">
        <div class="row">
       
            <div class="col-md-6">
              
              <div class="cambk">
  <!--------------- Affichage de la webcam ----------------------------------------->
                <div id="my_camera"></div>
                 </div>
                     <br>
  <!--------------- Bouton de capture ---------------------------------------------->
            
                   <button class="flash-button" onClick="take_snapshot()">Capturer</button><br>
                   
                <input type="hidden" name="image" class="image-tag">
             </div>
                   
      <div class="col-md-6">
       
   <button class="button"><img src="../images/arrow.png"></button><br>
   <!--------------- Affichage de la capture provenant du dossier "upload"---------------------------------------------->
  <div class="canvas-container" data-floorplan="../upload/<?php echo $fileName ?>">
  <!--------------- Canvas ---------------------------------------------->
                <canvas></canvas>
                </div>
               </div>
             <div class="furniture">
    <script language="JavaScript" type="text/javascript">

var Path='../images/';
// Recuperation des elements presents dans la BDD.
var phpArray = <?php echo $json;?> ;

function Swap(obj,id){
 var i=obj.selectedIndex;
 if (i<1){ return; }
 document.getElementById(id).src=Path+phpArray[i];
}
</script>
<!--------------- Selecteur de barbe ---------------------------------------------->
<div class="selector">
 <p>Faites glisser l'image sur votre capture.</p>
<select onchange="Swap(this,'MyImg');" >
<option >John</option>
<option >galifinakis</option>
<option >drhouse</option>
<option >justformen</option>
<option >hungergames</option>
<option >more</option>
</select>
<!--------------- Glisser - deposer ---------------------------------------------->
<img draggable="true" id="MyImg" src="../images/john.png" width=100 height=100 >
<br>

<!--------------- Rafraichissement de la page pour une nouvelle capture ---------------------------------------------->
<form method="post" action="">
     <input type="submit"  value="Mettre a jour"  id="update_button"  class="update_button"/>
</form>
<?php
if(isset($_POST['submit']))
        {
          echo "<meta http-equiv='refresh' content='0'>";
  }
?>
</div>
        </div>
        </div>
      </form>
      <div class="wrap">
      <button class="button" onclick="on()">Grille de centrage</button><br>
      </div>
      <footer>
   <!--------------- Acces a l'interface administrateur ---------------------------------------------->
      <a href="admin.php">Connexion</a><br><br>
			<span class="lien"class="lien" href="#">Copyright © 2019 </span>
      <a class="lien" href="../conditions-utilisation.html">Conditions d'utilisation</a>
           </footer>
</div>
<!-- Configure quelques parametres et attache la camera -->

<script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach( '#my_camera' );

    function take_snapshot() {
       Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            alert ("Capture effectuee !");
        } );
    }
</script>
<!-- Script du calque de positionnement en lien avec le css overlay -->
<script>
function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
}
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.2/jquery.fullPage.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.6/fabric.min.js'></script>
    <script  src="../js/index.js"></script>
</body>
</html>
