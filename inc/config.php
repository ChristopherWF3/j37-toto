<?php
session_start();


// Constante pour définir la configuration de la DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '1234');
define('DB_DATABASE', 'webforce');

// Connexion database 
$dsn = 'mysql:dbname=webforce;host=127.0.0.1;charset=UTF8';

try{
$pdo = new PDO($dsn, 'root', '1234');
}
catch(Exception $e){
	echo $e ->getMessage();
}
