<?php
require 'inc/config.php';

$errorList = array();
$successList = array();
$displayForm = false;


// Récupérer le token

$token = isset($_GET['token']) ? trim($_GET['token']) :'' ;


// Vérifier la validité du token et récupérer les données du user
if (strlen($token) == 32) {
	// Faire requete récupérant les données du user pour le token donné
	$sql = '
		SELECT *
		FROM user
		WHERE usr_token = :token
		LIMIT 1
	';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':token', $token);

	if ($stmt->execute() === false) {
		print_r($stmt->errorInfo());
	}
	else {
		// Je récupère les données ou false
		$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

		// Si valide, afficher le formulaire de modification du mot de passe, sinon, afficher une erreur
		if ($userInfo !== false) {
			$displayForm = true; // initialisé à false
		}
	}

}


// Formulaire soumis
if (!empty($_POST)) {
	// Récupérer les données du formulaire en POST
	$passwordToto1 = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) : '';
	$passwordToto2 = isset($_POST['passwordToto2']) ? trim($_POST['passwordToto2']) : '';

	$formOk = true;
	// Valider les données
	if ($passwordToto1 != $passwordToto2) {
		$errorList[] = 'Le mot de passe n\'est pas identique<br>';
		$formOk = false;
	}
	if (strlen($passwordToto1) < 8) {
		$errorList[] = 'Le password doit contenir au moins 8 caractères<br>';
		$formOk = false;
	}
	// Je vérifie que le token est bon, meme en POST
	if (!isset($userInfo) || $userInfo === false) {
		$formOk = false;
	}

	if ($formOk) {
		// Modifier le mot de passe du user
		// Supprimer le token dans la table user
		$sql = '
			UPDATE user
			SET usr_password = :password,
			usr_token = ""
			WHERE usr_id = :id
		';
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':id', $userInfo['usr_id'], PDO::PARAM_INT);
		$pdoStatement->bindValue(':password', password_hash($passwordToto1, PASSWORD_BCRYPT)); // password_hash

		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		else {
			$successList[] = 'Mot de passe réinitialisé<br>';
		}
	}
	
}


// View
require 'views/reset.php';