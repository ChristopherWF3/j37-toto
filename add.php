<?php
require 'vendor/autoload.php';

$etudiantListe = array();
$citiesList = array(
	1 => 'Esch-sur-Alzette',
	2 => 'Verdun',
	3 => 'Luxembourg',
	4 => 'Metz',
	5 => 'Differdange',
	6 => 'Rosport',
	7 => 'Bascharage',
	8 => 'Clervaux',
	10 => 'Strasbourg',
	11 => 'Nancy',
	18 => 'Thionville'
);
$countriesList = array(
	1 => 'Luxembourg',
	2 => 'France',
	3 => 'Belgique',
	4 => 'Chine',
	5 => 'Allemagne',
	6 => 'Bangladesh',
	8 => 'Malaisie',
);

$sympathieList = array(
	1 => 'Pas sympa',
	2 => 'Assez sympa',
	3 => 'Sympa',
	4 => 'Très sympa',
	5 => 'Génial',
);

if (!empty($_POST)) {
	// contrôle des données envoyées par la méthode POST
	$nom = isset($_POST['studentName']) ? strtoupper(trim($_POST['studentName'])) : '';
	$prenom = isset($_POST['studentFirstname']) ? trim($_POST['studentFirstname']) : '';
	$email = isset($_POST['studentEmail']) ? trim($_POST['studentEmail']) : '';
	$birthdate = isset($_POST['studentBirhtdate']) ? ($_POST['studentBirhtdate']) : '';
	$ville = isset($_POST['cit_id']) ? $_POST['cit_id'] : '';
	$sympathie = isset($_POST['stu_friendliness']) ? $_POST['stu_friendliness'] : '';

	//$age = 2016 - $birthdate;

	$formOk = true;
	// contrôle si nom entrée et plus de 3 caracteres 
	if (empty($nom)) {
		echo 'Entrez un nom<br>';
		$formOk = false;
	}
	else if (strlen($nom) < 3) {
		echo 'Le nom est incorrect (3 caractères min)<br>';
		$formOk = false;
	}

	// contrôle si prenom entrée et plus de 3 caracteres 
	if (empty($prenom)) {
		echo 'Entrez un prenom<br>';
		$formOk = false;
	}
	else if (strlen($prenom) < 3) {
		echo 'Le nom est incorrect (3 caractères min)<br>';
		$formOk = false;
	}
	
	// contôle si adresse email saisie dans le champ, si elle est vide => echo..
	if (empty($email)) {
		echo 'L\'adresse email est vide<br>';
		$formOk = false;
	}
	// contrôle de l'email, si elle est incorrecte => echo ... 
	else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		echo 'L\'adresse email est incorrecte<br>';
		$formOk = false;
	}

	else if($currentEtudiant['stu_email'] || $email){
		echo 'Adresse Email existe déjà<br>';
	}

	// contrôle si date de naissance entrée 
	if (empty($birthdate)) {
		echo 'Entrez une date de naissance<br>';
		$formOk = false;
	}

	// contrôle si ville choisie
	if (empty($ville)) {
		echo 'Sélectionnez une ville<br>';
		$formOk = false;
	}


	// contrôle si pays choisie
	if (empty($sympathie)) {
		echo 'Sélectionnez un niveau de sympathie<br>';
		$formOk = false;
	}
	

	// si le formulaire on rederige vers student.php 
	if ($formOk) {
		echo 'Formulaire OK <br>';
		// formulaire OK on insére le nouveau élève dans la BD
		$sqlPrepared = 'INSERT INTO student(stu_lname, stu_fname, stu_email, stu_age, city_cit_id, stu_friendliness)
						VALUES  (:nom, :prenom, :email, :age, :city, :friendliness)
						';

	$pdoStatementPrepared = $pdo->prepare($sqlPrepared);
	$pdoStatementPrepared->bindValue(':nom', $nom) ;
	$pdoStatementPrepared->bindValue(':prenom', $prenom) ;
	$pdoStatementPrepared->bindValue(':email', $email) ;
	$pdoStatementPrepared->bindValue(':age', $age) ;
	$pdoStatementPrepared->bindValue(':city', $ville) ;
	$pdoStatementPrepared->bindValue(':friendliness', $sympathie, PDO::PARAM_INT) ;

	if (!$pdoStatementPrepared->execute()) {
		print_r($pdoStatementPrepared->errorInfo());
	}
	else {
		header('Location: list.php');
		//$studentListe = $pdoStatementPrepared-> fetchAll();
	}
	}
}

// upload de fichiers 
if(!empty($_POST)){
			
			if(sizeof($_FILES)>0){

				$fileUpload = $_FILES['fileForm'];
				$filesize = $fileUpload['size']; // récuperer la taille du fichier

				$extension = substr($fileUpload['name'], -4);

				if(($extension == '.jpg') or ($extension == '.gif') or ($extension == '.png') or ($extension =='.svg') or ($extension =='jpeg')){

				if(move_uploaded_file($fileUpload['tmp_name'], 'files/'.$fileUpload['name'])){
					echo 'Fichier uploaded<br>';
				}
				else if ($filesize >= 204800){ // condition de vérification de la taille 
					echo "Erreur dans l'upload<br>";
				}
			}
	
	else {
		echo 'petit malin<br>';
	}

	}
	}


/*

// CODE CORRECTE

// Formulaire soumis
if (!empty($_POST)) {
	// Si des fichiers ont été téléversés
	if (sizeof($_FILES) > 0) {
		// Je récupère les données du fichier 'fileForm'
		$fileUpload = $_FILES['fileForm'];

		// Je teste si la taille n'est pas trop importante
		if ($fileUpload['size'] <= 100000) {
			// Je récupère l'extension
			$tmp = explode('.', $fileUpload['name']);
			$extension = end($tmp);

			// Tableau des extensions autorisées
			$allowedExtensions = array('png', 'svg', 'jpeg', 'jpg', 'gif');

			if (in_array($extension, $allowedExtensions)) {
				// Je téléverse le fichier
				if(move_uploaded_file($fileUpload['tmp_name'], 'files/test_upload'.$extension)) {
					echo 'fichier téléversé<br>';
				}
				else {
					echo 'Erreur dans le téléversement<br>';
				}
			}
			else {
				echo 'petit malin ^^<br>';
			}
		}
		else {
			echo 'Fichier trop grand...<br>';
		}
	}
}

*/

require 'views/header.php';
require 'views/addbody.php';
require 'views/footer.php';
?>
