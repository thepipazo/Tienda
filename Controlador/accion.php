<?php 
include "../db.php";

if(isset($_POST["getProduct"])){

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
									<img src='product_images/$pro_imagen' style='width:160px; height:250px;'/>
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






if(isset($_POST["categorias"])){
	echo "<div class='nav nav-pills nav-stacked'><li class='active'><a href='#'><h4>Categorias</h4></a></li>";
	$sql = "SELECT * FROM categoria";
	 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
	 $ok   = oci_execute( $stmt );              // Ejecutar la sentencia
	if( $ok == true )
	{
		 if( $obj = oci_fetch_object($stmt) )
		{
			 do
			 {
				$cid = $obj->CAT_ID;
				$cat_nombre = $obj->CAT_NOMBRE;
		
				echo "<li><a href='#' class='category' cid='$cid'>$cat_nombre</a></li>";
			 } while( $obj = oci_fetch_object($stmt) );			
		}
		else
			echo "<p>No Hay Libros En Venta</p>";
	}
	else
		$ok = false;
	 oci_free_statement($stmt);    	
}






if(isset($_POST["escritores"])){
    $sql = "SELECT * FROM escritor";
    
         $stmt = oci_parse($con, $sql);        // Preparar la sentencia
         $ok   = oci_execute($stmt);              // Ejecutar la sentencia
    echo "<div class='nav nav-pills nav-stacked'><li class='active'><a href='#'><h4>Escritores</h4></a></li>";
        if( $ok == true )
        {
             if( $row = oci_fetch_object($stmt) )
            {
                 do
                 {
                $bid = $row->ESCRITOR_ID;
                $escritor_nombre = $row->ESCRITOR_NOMBRE;
                echo "<li><a href='#' class='selectBrand' bid='$bid'>$escritor_nombre</a></li>";
                 } while( $row = oci_fetch_object($stmt) );			
            }
            else
                echo "<p>No Hay Libros En Venta</p>";
        }
        else
            $ok = false;
         oci_free_statement($stmt); 
    }