<?php 
include "../db.php";

if(isset($_POST["getProduct"])){

	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
		
		   
	
	$sql = "SELECT * FROM libros ";
	$filas = 0;
	 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
	 $ok   = oci_execute( $stmt );              // Ejecutar la sentencia
	if( $ok == true )
	{
		 if( $obj = oci_fetch_object($stmt) )
		{
			 do
			 {
				$pro_id = $obj->LIBRO_ID;
				$pro_cat = $obj->LIBRO_CAT;
				$pro_escritor= $obj->LIBRO_ESCR;
				$pro_nombre = $obj->LIBRO_NOMBRE;
				$pro_precio = $obj->LIBRO_PRECIO;
				//echo $obj->PRODUCT_IMAGE;
				$pro_imagen = $obj->LIBRO_IMAGEN;
				$pro_stock = $obj->STOCK;
				//<input  style='width:160px; height:250px;' type='button'  id='mymodal' name='mymodal'src='product_images/$pro_imagen' >

				echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_nombre</div>
								<div class='panel-body'>
									<img src='../product_images/$pro_imagen' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$.$pro_precio.00
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Añadir a la cesta</button>
								</div>
							</div>
						</div>	
			";
                        
			 } while( $obj = oci_fetch_object($stmt) );			
		}
		else
			echo "<p>No Hay Libros En Venta</p>";
	}
	else{
	echo "Error con la base de datos";
		$ok = false;
	 oci_free_statement($stmt);  
	}  	

	
}