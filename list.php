<?php

require 'inc/config.php';
require 'vendor/autoload.php';

$idSession = isset($_GET['id']) ? intval($_GET['id']):0;

// PAGINATION 
$page = isset($_GET['page']) ? intval($_GET['page']):1; // variable pour la pagination
$offset = ($page-1)*3;

$search = isset($_GET['q']) ? trim($_GET['q']) : ''; // variable pour recupérer la mot recherché



// si recherche
if (!empty($search)) {
  $sql ="SELECT stu_id, stu_lname, stu_fname, cit_name, cou_name, stu_friendliness
              FROM student
              LEFT OUTER JOIN city ON city.cit_id = student.city_cit_id
              LEFT OUTER JOIN country ON country.cou_id = city.country_cou_id
              WHERE stu_lname LIKE :search
              OR stu_fname LIKE :search
              OR stu_email LIKE :search
              OR stu_age LIKE :search
              OR cit_name LIKE :search
              OR cou_name LIKE :search
               ";

  $pdoStatement = $pdo -> prepare($sql);
  $pdoStatement ->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
}
// si session de formation
else if (!empty($idSession)) {
  $sql ="SELECT stu_id, stu_lname, stu_fname, cit_name, cou_name, stu_friendliness
              FROM student
              LEFT OUTER JOIN city ON city.cit_id = student.city_cit_id
              LEFT OUTER JOIN country ON country.cou_id = city.country_cou_id
              WHERE training_tra_id = $idSession
              LIMIT 3 OFFSET $offset
  ";
  $pdoStatement = $pdo -> prepare($sql);
}
// tous les etudiants
else {
  $sql ="SELECT stu_id, stu_lname, stu_fname, cit_name, cou_name, stu_friendliness
              FROM student
              LEFT OUTER JOIN city ON city.cit_id = student.city_cit_id
              LEFT OUTER JOIN country ON country.cou_id = city.country_cou_id
 ";
 $pdoStatement = $pdo -> prepare($sql);
}

// execute
if ($pdoStatement->execute() !== false) {
   $etudiantsList = $pdoStatement->fetchALL();
}
else{
  print_r($pdoStatement->errorInfo());
}



require 'views/header.php';
require 'views/listbody.php';
require 'views/footer.php';

