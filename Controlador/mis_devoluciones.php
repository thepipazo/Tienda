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

<div class="container" style="margin-bottom: 15px;">    
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#ja<?php echo $abrir ?>" aria-expanded="true" aria-controls="1"> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->ID_DEVOLUCION; ?> </th> 
                                        <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->ID_DETALLE; ?> </th> 
                                        <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->USER_ID ?> </th> 
                                        <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->FECHA_DEVOLUCION ?> </th> 
                                    </tr>
                                    <tr>
                                    <small>ID DEVOLUCIONES  &emsp;ID DEL DETALLE &emsp;&emsp;&emsp;&emsp;  ID USUARIO  &emsp;&emsp;&emsp; FECHA DEVUELTO </small>

                                    </tr>
                                </thead>
                                
                            </table>  
                            
                        </button>
                    </h2>
                </div>

                <div id="ja<?php echo $abrir ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                    <div class="card-body">
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID devolucion</th>
                                        <th scope="col">ID usuario</th>
                                        <th scope="col">Motivo</th>
                                        <th scope="col">Fecha Devolucion</th>
                                        <th scope="col">ID Venta</th>
                                        <th scope="col">Portada</th>
                                    </tr>
                                </thead>
                            <tbody>
                             
                                    <tr>
                                    
                                    <td><?php echo  "$row->ID_DEVOLUCION"?></td>
                                    <td><?PHP echo  "$row->USER_ID"?></td>
                                    <td><?php echo  "$row->MOTIVO"?></td>
                                    <td><?php echo  "$row->FECHA_DEVOLUCION"?></td>
                                    <td><?php echo  "$row->BOUCHER"?></td>
                                    <td><?php echo  "<img src='../../product_images/$libro_image' width='60px' height='50px'></img>"?></td>
                                    </tr>
                                
                                <?php
                                        
                                ?>
                            </tbody>
                        </table>                                     
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
$abrir++;
}
}
?>




  
	
