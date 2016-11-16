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


// fonction pour envoyer un mail pour nouveau password
function envoiEmail ($to, $subject, $message){

require '../PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp-mail.outlook.com';  // Specify main and backup SMTP servers GOOGLEMAIL: smtp.googlemail.com
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'duhrchristopher@hotmail.com';                 // SMTP username .pgw pour google
$mail->Password = file_get_contents('../pwd.txt');                           // SMTP password file_get_contents('pwd.txt') (dirname(__FILE__).)
$mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('duhrchristopher@hotmail.com', 'Christopher');
$mail->addAddress($to);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $message;
$mail->AltBody = strip_tags($message);

return $mail->send();

}
