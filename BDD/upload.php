<?php
 /**
 * Simulateur de barbe - Projet d'exament AFORMAC 2019 pour Direct Webmaster - BRODAR Frederic © Tous droits réservés - 2019 
 */

if(!isset($_SESSION['admin_id']) || !isset($_SESSION['logged_in'])){
     echo 'Vous êtes deconnecté!';
   // header('Location: admin.php');
    exit;
}
echo 'Vous êtes connecté!';
?>
<!--------------- Telechargement de nouveaux elements si connecte---------------------------------------------->
<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-25">
            <label for="files">Nouvelles images de barbes.</label>
                </div>
                    <div class="col-75">
                        <input type="file" name="files[]" multiple>
                            </div>
                                 <div class="col-25">    
                            <input type="submit" value="Upload File" name="submit">
                        </div>
                    </div>
                </form>
 
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['files'])) {
        $errors = [];
        $path = '../images/';
	$extensions = ['jpg', 'jpeg', 'png', 'gif']; // Les extensions autorisees.
		
        $all_files = count($_FILES['files']['tmp_name']);

        for ($i = 0; $i < $all_files; $i++) {  
		$file_name = $_FILES['files']['name'][$i];
		$file_tmp = $_FILES['files']['tmp_name'][$i];
		$file_type = $_FILES['files']['type'][$i];
		$file_size = $_FILES['files']['size'][$i];
		$file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i])));

		$file = $path . $file_name;

		if (!in_array($file_ext, $extensions)) {
			$errors[] = 'Extension non permise: ' . $file_name . ' ' . $file_type;
		}

		if ($file_size > 2097152) {
			$errors[] = 'La taille dépasse la limite: ' . $file_name . ' ' . $file_type; // Controle de la taille du fichier.
		}

		if (empty($errors)) {
			move_uploaded_file($file_tmp, $file);
        }
        
        $connfile2="db.php";
        if (file_exists($connfile2)) {
            //echo "Le fichier $filename existe.";
            require "db.php";
        } else {
            //echo "Le fichier $filename n'existe pas.";
            require "dbs.php";
        }
        
// Insertion de ces nouveaux elements dans la table images represente par son nom de fichier (nomBr).

$sql = "INSERT INTO images (nomBr) VALUES ('$file_name')"; 

if ($conn->query($sql) === TRUE) {
    echo "Nouvel enregistrement crée avec succès.";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
	}

	if ($errors) print_r($errors);
    }
}
?>
<script>
const url = 'upload.php';
const form = document.querySelector('form');

form.addEventListener('submit', e => {
    e.preventDefault();

    const files = document.querySelector('[type=file]').files;
    const formData = new FormData();

    for (let i = 0; i < files.length; i++) {
        let file = files[i];

        formData.append('files[]', file);
    }

    fetch(url, {
        method: 'POST',
        body: formData
    }).then(response => {
       console.log(response);
        alert ("Upload effectué !");
    });
});
</script>
