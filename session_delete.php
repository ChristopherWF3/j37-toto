<?php

session_start();

unset($_SESSION['tata']);

if(isset($_GET['all'])){
	session_unset();
}

echo 'supprimé';