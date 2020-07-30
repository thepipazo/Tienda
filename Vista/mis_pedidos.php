                <?php
session_start();
if(!isset($_SESSION["uid"]) or $_SESSION['tipo_user'] == 1 ){
	header("location:index.php");
}
				include "../db.php";
if(isset($_POST["pedido"])){	
	?>
<strong>ID DETALLE  &emsp;  &emsp;&emsp;&emsp;USUARIO &emsp;&emsp;  TOTAL  &emsp; FECHA ENVIADO  &emsp; &emsp;&emsp;&emsp; &emsp;&emsp; &emsp;GARANTIA HASTA</strong>
	<?php			

$user = $_SESSION["uid"];
$sql = "select*from detalleventa where user_id = $user";
$run_sql = oci_parse($con,$sql);
$ok = oci_execute($run_sql);
$abrir = 1;
$cerrar = "id".$abrir;
while($row = oci_fetch_object($run_sql)){
	$iddetalle= $row->IDDETALLE;
	
?>

    <div class="panel-group">
    <div class="panel panel-default">
    <div class="panel-heading">
	
      <h4 class="panel-title">
      <table class="table">
      <thead>
	<tr>
  <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->IDDETALLE ?> </th> 
  <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->USER_ID ?> </th> 
  <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->TOTAL_COMPRA ?> </th> 
  <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->FECHA_REALIZADA ?> </th> 
  <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->FECHA_VENCE_GAR ?> </th> 


    </tr>
  </thead>
  
  </table>
      </h4>
    </div>
    <div id="<?php echo $abrir ?>" class="panel-collapse collapse">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID Libro</th>
      <th scope="col">Portada</th>
      <th scope="col">Nombre Libro</th>
      <th scope="col">Precio</th>
      <th scope="col">ID Detalle</th>
      <th scope="col">Devolver</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        $sql2="SELECT v.idventa,v.idlibro,l.libro_imagen,l.libro_nombre,l.libro_precio,d.iddetalle from venta v join detalleventa d on v.IDDETALLE = d.IDDETALLE join libros l on v.idlibro = l.LIBRO_ID WHERE d.USER_ID=$user and d.iddetalle=$iddetalle" ;
	
		$run_query = oci_parse($con,$sql2);
        $ok= oci_execute($run_query);
        while($row = oci_fetch_object($run_query)){
            $libro_image = $row->LIBRO_IMAGEN;

?>
    <tr>
      
      <td><?php echo $row->IDLIBRO?></td>
      <td><?php echo " <div class='col-md-3 col-xs-3'><img src='product_images/$libro_image' width='60px' height='50px'></div>" ?></td>
      <td><?PHP echo  "$row->LIBRO_NOMBRE"?></td>
      <td><?php echo  "$row->LIBRO_PRECIO"?></td>
      <td><?php echo  "$row->IDDETALLE"?></td>
      <td><?php echo "<a href='formulario_devolucion.php?idventa=$row->IDVENTA&idlibro=$row->IDLIBRO&iddetalle=$row->IDDETALLE'> <span class='glyphicon glyphicon-repeat'></span></a>'"?></td>
    </tr>
   
   <?php
        }
        ?>
  </tbody>
</table>
    </div>
  </div>
</div>


<?php
$abrir++;
}

}
?>
