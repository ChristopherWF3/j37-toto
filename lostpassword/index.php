<?php
require 'inc/config.php';

'<meta charset ="utf-8">';

$errorList = array();
$successList = array();
$emailLoginToto = '';

// Formulaire soumis
if (!empty($_POST)) {
	$emailLoginToto = isset($_POST['emailLoginToto']) ? trim($_POST['emailLoginToto']) : '';

	$formOk = true;
	if (empty($emailLoginToto)) {
		$errorList[] = 'Email est vide<br>';
		$formOk = false;
	}
	else if (!filter_var($emailLoginToto, FILTER_VALIDATE_EMAIL)) {
		$errorList[] = 'Email invalide<br>';
		$formOk = false;
	}

	if ($formOk) {
		// Récupérer les données de l'utilisateur s'il existe
		$sqlUser =' SELECT *
					FROM user
					WHERE usr_email = :email
					';

				$pdoStatement = $pdo->prepare($sqlUser);
					$pdoStatement->bindValue(':email', $emailLoginToto);
						
							if($pdoStatement->execute() !== false){

								$userInfo = $pdoStatement->fetch(PDO::FETCH_ASSOC);

							if($userInfo !== false){
								// Générer un token à partir d'une donnée du user
								$Token = md5(time().'lostpassword'.$userInfo['usr_id']);

								
								// Modifier la ligne du user dans la table user pour y mettre le token généré

								$sqlToken ='UPDATE user
											SET usr_token = :token
											WHERE usr_id = :id
											';

									$stmt = $pdo->prepare($sqlToken);
										$stmt->bindValue(':token', $Token);
										$stmt->bindValue(':id', $userInfo['usr_id'], PDO::PARAM_INT);

											if($stmt->execute() === false){
												print_r($stmt->errorInfo());	
											}else{
												// Envoyer un email avec le lien pour réinitialiser le password (token)
												$htmlContent = 'Lien pour <a href="http://localhost/j37-toto/lostpassword/reset.php?token='.$Token.'">réinitialiser</a>.<br>';

												$sent =	envoiEmail($userInfo['usr_email'], 'Réinitialiser votre mot de passe', $htmlContent);
												
											if ($sentOK) {
												// Si tout est ok
												$successList[] = 'Un email vous permettant de réinitialiser votre mot de passe vient de vous être envoyé<br>';
											} // fermeture IF sent OK 
											else{
												$errorList[] = 'Adresse mail inconnue<br>';
											} // fermeture ELSE 
											}

							}
						}
	
	}
}

// View
require 'views/lostpassword.php';

