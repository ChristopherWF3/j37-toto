<?php

require 'inc/config.php';
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
		$sqlUpdate = 'UPDATE student(stu_lname, stu_fname, stu_email, stu_age, city_cit_id, stu_friendliness)
						SET  (:nom, :prenom, :email, :age, :city, :friendliness)
						WHERE
						';

	$pdoStatementPrepared = $pdo->prepare($sqlUpdate);

	$pdoStatementPrepared->bindValue(':nom', $nom) ;
	$pdoStatementPrepared->bindValue(':prenom', $prenom) ;
	$pdoStatementPrepared->bindValue(':email', $email) ;
	$pdoStatementPrepared->bindValue(':age', $age) ;
	$pdoStatementPrepared->bindValue(':city', $ville) ;
	$pdoStatementPrepared->bindValue(':friendliness', $sympathie, PDO::PARAM_INT) ;

	if (!$pdoStatementPrepared->execute()) {
		header("Location: student.php?id="); // si tout est OK rediriger sur student.php?id=XX
	}
	else {
		print_r($pdoStatementPrepared->errorInfo());
	}
	}
}


require 'views/header.php';
require 'views/updatebody.php';
require 'views/footer.php';
?>
