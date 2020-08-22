<?php
include "../db.php";

session_start();

if(isset($_POST["userLogin"])){
	
	$email = $_POST["userEmail"];
	$password = md5($_POST["userPassword"]);
	$sql = "SELECT * FROM user_info WHERE email = '$email' AND password = '$password' and estado = 0";
	$run_query = oci_parse($con,$sql);
	$ok = oci_execute($run_query);
	$row = oci_fetch_object($run_query);
	$count = oci_num_rows($run_query);

	if($count == 1){
		$_SESSION["pass"] = $_POST["userPassword"];
		$_SESSION["uid"] = $row->USER_ID;
		$_SESSION["name"] = $row->NOMBRES;
		$_SESSION["rut_c"] = $row->RUT;
		$_SESSION['password']= $row->PASSWORD;
		$_SESSION["email"]= $email;
		$_SESSION['tipo_user']= $row->UER_ADMIN;
		$_SESSION['iddetalle']=0;

			if($_SESSION['tipo_user'] == 0){
				
				echo 0;
			
			}elseif($_SESSION['tipo_user'] == 1 ){
				echo 1;
			}
		}else{
			echo 2;
		}
	
}











/*


	$sql = "SELECT * FROM user_info WHERE email = '$email' AND password = '$password'";
	$run_query = oci_query($con,$sql);
	$count = oci_num_rows($run_query);

	if($count == 1){
		$row = mysqli_fetch_array($run_query);
		$_SESSION["uid"] = $row["user_id"];
		$_SESSION["name"] = $row["first_name"];
			
		}else{
			echo "nada";
		}
	
}
*/
?>