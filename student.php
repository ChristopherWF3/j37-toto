<?php
require 'inc/config.php';
require 'vendor/autoload.php';

$idSession = $_GET["id"];


$sqlSelect2 = "SELECT stu_id, stu_lname, stu_fname, stu_email, cit_name, cou_name, stu_friendliness, stu_age 
       		   FROM student
        	   LEFT OUTER JOIN city ON city.cit_id = student.city_cit_id
        	   LEFT OUTER JOIN country ON country.cou_id = city.country_cou_id
    		   WHERE ".$idSession." = stu_id 
            ";
    //    echo $sqlSelect2;

$pdoStatement = $pdo->query($sqlSelect2); 

if ($pdoStatement === false){
	print_r($pdo->errorInfo());
}else{
	$studentInfo = $pdoStatement->fetch();
	
}



require 'views/header.php';
require 'views/studentbody.php';
require 'views/footer.php';
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
     
      $.ajax({
        url:  'ajax/student.php',
        type: 'POST'
        }); 

       $.ajax({
        url:  'ajax/student.php',
        type: 'POST',
        data: {  },
        dataType: "html"
        }); 

    }); // Fermeture JQuery
</script>
