<?php


require 'inc/config.php';
require 'vendor/autoload.php';


// Formulaire soumis
if (!empty($_POST)) {
	$emailLoginToto = isset($_POST['emailLoginToto']) ? trim($_POST['emailLoginToto']) : '';
	$passwordLoginToto1 = isset($_POST['passwordLoginToto1']) ? trim($_POST['passwordLoginToto1']) : '';


	$formOk = true;
	if (strlen($passwordLoginToto1) < 8) {
		echo 'Le password doit contenir au moins 8 caractères<br>';
		$formOk = false;
	}
	if (empty($emailLoginToto)) {
		echo 'Email est vide<br>';
		$formOk = false;
	}
	else if (!filter_var($emailLoginToto, FILTER_VALIDATE_EMAIL)) {
		echo 'Email invalide<br>';
		$formOk = false;
	}

	if ($formOk) {
		/*$sql = '
			SELECT *
			FROM user
			WHERE usr_email = :email
			AND usr_password = :pwd
			LIMIT 1
		';
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':email', $emailLoginToto);
		//$pdoStatement->bindValue(':pwd', md5($passwordLoginToto1)); // md5 simple
		$pdoStatement->bindValue(':pwd', md5($passwordLoginToto1.'jhdvb9l78!okcvnflk')); // md5 + salt

		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		else {
			if ($pdoStatement->rowCount() > 0) {
				echo 'login ok<br>';
			}
			else {
				echo 'bad password or login<br>';
			}
		}*/

		$sql = '
			SELECT *
			FROM user
			WHERE usr_email = :email
			LIMIT 1
		';
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':email', $emailLoginToto);

		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		else {
			if ($pdoStatement->rowCount() > 0) {
				$resList = $pdoStatement->fetch();
				$hashedPassword = $resList['usr_password'];

				// Je vérifie le mot de passe
				if (password_verify($passwordLoginToto1, $hashedPassword)) {
					echo 'login ok<br>';

					$_SESSION['userID'] = $resList['usr_id'];
					

				}
				else {
					echo 'bad password or login<br>';
				}
			}
			else {
				echo 'email not known<br>';
			}
		}
	}
}

require 'views/header.php';
require 'views/signinbody.php';
require 'views/footer.php';

?>
				