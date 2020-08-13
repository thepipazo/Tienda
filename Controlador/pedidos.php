<?php
include "../db.php";
session_start();
if(isset($_POST["pedido"])){	
	?>
	<?php			

$user = $_SESSION["uid"];
$sql = "select*from detalleventa where user_id = $user";
$run_sql = oci_parse($con,$sql);
$ok = oci_execute($run_sql);
$abrir = 1;
while($row = oci_fetch_object($run_sql)){
    $iddetalle= $row->IDDETALLE;
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
                                        <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->IDDETALLE ?> </th> 
                                        <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->USER_ID ?> </th> 
                                        <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->TOTAL_COMPRA ?> </th> 
                                        <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->FECHA_REALIZADA ?> </th> 
                                        <th data-toggle="collapse" href="#<?php echo $abrir ?>"scope="col"><?php echo $row->FECHA_VENCE_GAR ?> </th> 
                                    </tr>
                                    <tr>
                                    <small>ID DETALLE  &emsp;USUARIO &emsp;&emsp;  TOTAL  &emsp;&emsp; &emsp;&emsp;&emsp;&emsp; FECHA ENVIADO  &emsp;&emsp;&emsp; &emsp;&emsp; &emsp;GARANTIA HASTA</small>

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
                                    <th scope="col"><?php echo $abrir ?></th>
                                    <th scope="col">Portada</th>
                                    <th scope="col">Nombre Libro</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Ejemplares</th>                                
                                    <th scope="col">Devolver</th>
                                    </tr>
                                </thead>
                            <tbody>
                                <?php 
                                        $sql2="SELECT v.idventa,v.idlibro,V.cantidad,l.libro_imagen,l.libro_nombre,l.libro_precio,d.iddetalle from venta v join detalleventa d on v.IDDETALLE = d.IDDETALLE join libros l on v.idlibro = l.LIBRO_ID WHERE d.USER_ID=$user and d.iddetalle=$iddetalle" ;
                                    
                                        $run_query = oci_parse($con,$sql2);
                                        $ok= oci_execute($run_query);
                                        while($row = oci_fetch_object($run_query)){
                                            $libro_image = $row->LIBRO_IMAGEN;

                                ?>
                                    <tr>
                                    
                                        <td><?php echo $row->IDLIBRO?></td>
                                        <td><?php echo " <div class='col-md-3 col-xs-3'><img src='../../product_images/$libro_image' width='60px' height='50px'></div>" ?></td>
                                        <td><?PHP echo  "$row->LIBRO_NOMBRE"?></td>
                                        <td><?php echo  "$row->LIBRO_PRECIO"?></td>
                                        <td><?php echo  "$row->CANTIDAD"?></td>                                        
                                        <td><?php echo "<a href='formulario_devolucion.php?idventa=$row->IDVENTA&idlibro=$row->IDLIBRO&iddetalle=$row->IDDETALLE'><i class='fa fa-undo' aria-hidden='true'></i>"?></td>
                                    </tr>
                                
                                <?php
                                        }
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