<?php
require 'inc/config.php';
require 'vendor/autoload.php';




// requête pour page d'accueil => afficher toutes les séances 

$sql = 'SELECT tra_id, tra_start_date, tra_end_date, loc_name, count(*) AS Effectif
		FROM training
		LEFT OUTER JOIN location ON location.loc_id = training.location_loc_id
		LEFT OUTER JOIN student ON student.training_tra_id = training.tra_id
		GROUP BY tra_id, tra_start_date, tra_end_date, loc_name
		';

$pdoStatement = $pdo -> query($sql);

if ($pdoStatement === false){
	print_r($pdo->errorInfo());
}else{
	$trainingList = $pdoStatement-> fetchAll();

}



// VIEW
require 'views/header.php';
require 'views/home.php';
require 'views/footer.php';

?>

