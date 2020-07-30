<?php
session_start();
if(!isset($_SESSION["uid"]) or $_SESSION['tipo_user'] == 1 ){
	header("location:../index.php");
}
				include "../db.php";
if(isset($_POST["devolucion"])){	
	?>
	<?php			

$user = $_SESSION["uid"];
$sql = "select*from devuelto where user_id = $user";
$run_sql = oci_parse($con,$sql);
$ok = oci_execute($run_sql);
$abrir = 1;
$cerrar = "id".$abrir;
while($row = oci_fetch_object($run_sql)){


	$sql2 = "select libro_imagen from libros where libro_id  = $row->LIBRO_ID";
	
	$run_sql2 = oci_parse($con,$sql2);
	$ok2 = oci_execute($run_sql2);
	$row2 = oci_fetch_object($run_sql2);
	$libro_image = $row2->LIBRO_IMAGEN;


	
?>

  
	
      <h4 class="panel-title">
      <table class="table">
      <thead>
	<tr>
  

    </tr>
  </thead>
  
  </table>
      </h4>
    </div>
    
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID devolucion</th>
      <th scope="col">ID usuario</th>
      <th scope="col">Motivo</th>
      <th scope="col">Fecha Devolucion</th>
      <th scope="col">Boucher</th>
	  <th scope="col">Portada</th>
    </tr>
  </thead>
  
     
    <tr>
      
      <td><?php echo $row->ID_DEVOLUCION?></td>
      <td><?PHP echo  "$row->USER_ID"?></td>
      <td><?php echo  "$row->MOTIVO"?></td>
      <td><?php echo  "$row->FECHA_DEVOLUCION"?></td>
	  <td><?php echo  "$row->BOUCHER"?></td>
	  <td><?php echo  "<img src='product_images/$libro_image' width='60px' height='50px'></img>"?></td>
	  
	

    </tr>
   
   <?php
        }
        ?>
  
</table>
 
  </div>



<?php
$abrir++;
}


?>
