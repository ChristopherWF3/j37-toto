<?php

require 'inc/config.php';
require 'vendor/autoload.php';


$emailToto = '' ;

	if(!empty($_POST)){

		$emailToto = isset($_POST['emailToto']) ? trim($_POST['emailToto']) : '';
		$passwordToto1 = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) : '';
		$passwordToto2 = isset($_POST['passwordToto2']) ? trim($_POST['passwordToto2']) : '';

		$formOk = true;
			if($passwordToto1 != $passwordToto2){
				echo 'le mot de passe n\'est pas identique<br>';
				$formOk = false;
			}
			if(strlen($passwordToto1) < 8){
				echo '8 caractères minimum<br>';
				$formOk = false;
			}
			if(empty($emailToto)){
				echo 'Email est vide<br>';
				$formOk = false;
			}
			else if(!filter_var($emailToto, FILTER_VALIDATE_EMAIL)){
				echo 'Email invalide<br>';
				$formOk = false;
			}

			if($formOk){
				echo 'Formulaire OK<br>';

				$sql ='INSERT INTO user(usr_email, usr_password)
						VALUES (:email, :password)
						';

					$pdoStatement = $pdo->prepare($sql);

					$pdoStatement->bindValue(':email', $emailToto);
					$pdoStatement->bindValue(':password', password_hash($passwordToto1, PASSWORD_BCRYPT));

					if($pdoStatement->execute() === false){
						print_r($pdoStatement->errorInfo());
					}else{
						$_SESSION['userID'] = $pdo->lastInsertId();
						header('Location: index.php');
					}

					
			}
	}

require 'views/header.php';
require 'views/signupbody.php';
require 'views/footer.php';

?>

