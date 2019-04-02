<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="" type="image/x-icon"/>
  <title>Identifiants Mysql</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
      <link rel="stylesheet" href="css/install.css">
      
  <!---Simulateur de barbe - Projet d'exament AFORMAC 2019 pour Direct Webmaster - BRODAR Frederic © Tous droits réservés - 2019-----> 
 
 </head>

<body>
<h2>Configuration de la base de donnée.</h2>
<span class="warn">
<h3>Important !</h3>
<p>Les droits d'accès en écriture chmod 777 doivent être appliqué aux dossiers : upload et images.</p></span>
<h4>Configuration automatique des fichiers - Problèmes pouvant être rencontré :</h4>
<p>Un échec de l'installation peut être causé par une mauvaise configuration des droits en écriture du fichier : jsondb.json, 
    ou de son absence, il est dans ce cas necéssaire de le créer manuellement.</p> 
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
    <footer>
    	<span class="lien"class="lien" href="#">Copyright © 2019 </span>
        <a class="lien" href="condition-utilisation.html">Conditions d'utilisation</a>
           </footer>
</body>
</html>
