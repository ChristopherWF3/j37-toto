<html>
<head>
	<title>Projet</title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="maxsize">
	<div class="container">
	<nav class="navbar navbar-pills">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="index.php">Toutes les sessions</a></li>
	        <li><a href="add.php">Ajouter un étudiant</a></li>
	        <li><a href="list.php">Tous les étudiants</a></li>
	  
	        <?php if (!empty($_SESSION['userID'])) : ?>
	        	<li><?= $_SESSION['userID']?></li>
	        	<li><a href ="disconnect.php">Déconnexion</a></li>
	        <?php else :?>

	        <li><a href="signup.php">S'inscrire</a></li>
	        <li><a href="signin.php">Se connecter</a></li>

	    <?php endif; ?><li>

	      </ul>
	      <form action="list.php" method="get" class="navbar-form navbar-right">
	        <div class="form-group">
	          <input type="text" name="q" class="form-control" placeholder="Recherche" value="<?= isset($search) ? $search : '' ?>">
	        </div>
	        <button type="submit" class="btn btn-default">Rechercher</button>
	      </form>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>