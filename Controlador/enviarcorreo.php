<?php
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
include "db.php";
$email = $_SESSION["email"];


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function


// Load Composer's autoloader
//require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$mail->SMTPOptions = array (
	'ssl' => array (
	'verificar_peer'=>false,
	'verificar_peer_name'=>false,
	'allow_self_signed'=>true
	)
	);

try {
	//Server settings
	$mail->isSMTP();    
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
                                            // Send using SMTP
	$mail->Host = "smtp.gmail.com";                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'pipepasionazul17@gmail.com';                     // SMTP username
    $mail->Password   = '77255444';                               // SMTP password
    $mail->SMTPSecure = 'tls';       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 25;                                    // TCP port to connect to
	
    //Recipients
    $mail->setFrom('lxluxo23@gmail.com', 'PROYECTO');
    $mail->addAddress($email, 'luis fuentes');     // Add a recipient
   /* $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    // Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
*/
	// Content
	 
	$mail->isHTML(true); 
	
	if(isset($_GET["hello"])){   

	
	$num =  rand ( 1000, 99999 );
	
    $mail->Subject = 'Correos De Prueba';
	$mail->Body    = 'Tu codigo de recuperacion Es  <b>'.$num.'</b>';
	

	if (insertarCodigo($con,$num)== true){ 
		if($mail->send()){
			
			header("location:codigo.php");
		}
		
	}else{
		header("location:codigo.php");

		
	
	}
}


if(isset($_POST["codigo"])){ 
	$id = $_SESSION["iddetalle"];
	$mail->Subject = 'Correos De Prueba';
	$mail->Body    = 'Estimado <b>'.$_SESSION['name'].'</b> su pedido Fue Realizado Con Exito, El ID del pedido es <b>'.$id.'</b> 
	y llegara Aproximadamente el dia <b>'.$_SESSION['fecha'].'</b>';
	if($mail->send()){
		echo 1;
		exit();
	}else{
		echo 2;
		exit();
	}

}

	


} catch (Exception $e) {
    //echo "Error Al Enviar El Correo. Mailer Error: {$mail->ErrorInfo}";
} 

function insertarCodigo($con,$num)
{
$msg = false;
	 $id = $_SESSION["uid"];
	 $sql = "select*from codigo_recuperacion where user_id = '$id'";
	 $run_query = oci_parse($con,$sql);
	$ok = oci_execute($run_query);
	$row = oci_fetch_all($run_query,$res);
	$count = oci_num_rows($run_query);
	
	 if($count > 0){

		$msg = false;

	 }else{
		
		$sql = "INSERT INTO codigo_recuperacion VALUES (null, $num ,$id)";
		 $stmt = oci_parse($con, $sql);      // Preparar la sentencia
		 $ok   = oci_execute($stmt);            // Ejecutar la sentencia
		 oci_free_statement($stmt);
		 //oci_close($stmt);	 

		$msg = true;
	 }
return $msg;


	
}
