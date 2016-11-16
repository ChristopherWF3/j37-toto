		
<?php

session_start();

if(!empty($_POST)){
	$key = isset($_POST['key']) ? $_POST['key'] : '';
	$value = isset($_POST['value']) ? $_POST['value'] : '';

	$_SESSION[$key] = $value;
}

if(isset($_GET['deleteId'])){
	$id = trim($_GET['deleteId']);

	if (array_key_exists($id, $_SESSION)){
		unset($_SESSION[$id]);
	}

	header('Location: session.php');
	exit;

}

if(!empty($_SESSION)){
	foreach ($_SESSION as $key => $value) {
		$$key = $value;
	}
}


?>

<html>
<head>
	<title>Sessions</title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
			<div class="col-md-8 col-sm-8 col-xs-12">


<form action="" method="post">
	<fieldset>
		<legend>Play with PHP Session</legend>
		<input type="text" name="key" value="" placeholder="Clé tableau session" class="form-control"/><br />
		<input type="text" name="value" value="" placeholder="Valeur tableau session" class="form-control"/><br />
		<input type="submit" value="Add to $_SESSION" class="btn btn-info"/>
	</fieldset>
</form>


<div class ="col-md-6 col-sm-6 col-xs-6">
<h3>Variables de session <small> </small></h3>
<table class="table">
<thead>
<tr>
	<th>Nom</th>
	<th>Valeur</th>
	<th></th>
</tr>
</thead>
<tbody>

<?php foreach ($_SESSION as $nom => $valeur) :  ?>
	<tr>
		<td><?= $nom ?></td>
		<td><?php print_r($valeur) ?></td>
		<td><a class ="btn btn-danger btn-xs" href="session.php?deleteId=<?=$nom?>"> X </a></td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</body>
</html>
