<!DOCTYPE html>
<html lang="fr" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
  <title>Identifiants Mysql</title>
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

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
      <link rel="stylesheet" href="css/install.css">
      
  <!---Simulateur de barbe - Projet d'exament AFORMAC 2019 pour Direct Webmaster - BRODAR Frederic © Tous droits réservés - 2019
  Name: phobos || Software: barbes_simulateur || License Key: U8C3-25M5-ZYG2-EPAA
  -----> 
 
 </head>

<body>
 <h1>Simulateur de barbe</h1>   
<h3>Configuration de la base de donnée.</h3>
<span class="warn">
<h4>Important !</h4>
<p>Les droits d'accès en écriture chmod 777 doivent être appliqué aux dossiers : upload et images.</p></span>
<h5>Configuration automatique des fichiers - Problèmes pouvant être rencontré :</h5>
<p>Un échec de l'installation peut être causé par une mauvaise configuration des droits en écriture du fichier : jsondb.json, 
    ou de son absence, il est dans ce cas necéssaire de le créer manuellement.</p>
    <p>L'installation requière un numéro de série ou clé de licence:<br>
         ex : XXXX-XXXX-XXXX-XXXX.</p><br> 
<!--------------- Introduction des informations de connexion BDD ( Base de donnee mysql ) ---------------------------------------------->
  <form id="test" action="#" method="post">
    <div class="form-group">
        <label for="servername">hostname</label>
        <input class="form-control" type="text" name="servername" id="servername" required/>
    </div>
    
    <div class="form-group">
        <label for="username">Utilisateur</label>
        <input class="form-control" type="text" name="username" id="username" required/>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input class="form-control" type="password" name="password" id="password" required/>
    </div>
    <div class="form-group">
        <label for="dbname">Base de donnée</label>
        <input class="form-control" type="text" name="dbname" id="dbname" required/>
    </div>
    <p>
        <input type="submit" value="Envoyer" class="btn btn-primary btn-block" />
    </p>
</form>	
<pre id="output"></pre>
  <!--------------- Encodage des informations saisies en format json ---------------------------------------------->
    <script>
    (function() {
	function toJSONString( form ) {
		var obj = {};
		var elements = form.querySelectorAll( "input, select, textarea" );
		for( var i = 0; i < elements.length; ++i ) {
			var element = elements[i];
			var name = element.name;
			var value = element.value;

			if( name ) {
				obj[ name ] = value;
			}
		}
		return JSON.stringify( obj );
	}

	document.addEventListener( "DOMContentLoaded", function() {
		var form = document.getElementById( "test" );
		var output = document.getElementById( "output" );
		form.addEventListener( "submit", function( e ) {
			e.preventDefault();
			var json = toJSONString( this );
			output.innerHTML = json;
            console.log (json);
            window.location.href = "BDD/dbx.php?json=" + json; // Redirection en mode "POST" pour transmettre les donnees json.
			
		}, false);

	});

})();
  </script>
  <div class="sup">
  <span class="warn">
        <p>Important ! Supprimer ce fichier à la fin de l'installation !</p></span>
    <form method="post">
   <input id="flash-button" name="delete" type="submit" value="Supprimer">
</form>  
  <?php
    if(isset($_POST['delete']))
    {
        unlink(__FILE__);
    }
?>
</div>
    <footer>
      	<span class="lien" href="#">Copyright © 2019 </span> -•- <a class="lien" href="conditions-utilisation.html">Conditions d'utilisation</a>
           </footer>
</body>
</html>
