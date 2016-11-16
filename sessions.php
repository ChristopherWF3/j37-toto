<?php

session_start();

print_r($_SESSION);

$_SESSION['toto'] = 45;

$_SESSION['tata'] = 'lolol';