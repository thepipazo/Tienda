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
	



	
	if(isset($_POST["getProduct_admin"])){
		
		$pro_nombre="";
		$limit = 9;
		if(isset($_POST["setPage"])){
			$pageno = $_POST["pageNumber"];
			$start = ($pageno * $limit) - $limit;
		}else{
			$start = 0;
		}
	
		$sql = "SELECT * FROM libros where estado = 1 ";
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
					$descripcion = $obj->LIBRO_DESCR;
					$nombre_corto = substr($pro_nombre, 0 , 19);

					//echo $obj->PRODUCT_IMAGE;
					$pro_imagen = $obj->LIBRO_IMAGEN;
					$pro_stock = $obj->STOCK;
					//<input  style='width:160px; height:250px;' type='button'  id='mymodal' name='mymodal'src='product_images/$pro_imagen' >
	
					echo "
					
						<div class='col-md-4'  >
									<div class='panel panel-info' style= 'width: 200px;'>
										<div class='panel-heading'  style= 'width: 200px;' >$nombre_corto...
										<h style='float:right;'>$pro_stock/U </h>
										</div>
										<div class='panel-body'>
									
											
											<image type='image' src='../product_images/$pro_imagen'  style='width:200%px; height:300px; margin-left:-15px; margin-top:-15px; margin-bottom:-15px;'></image>
											
							
										</div>
										<div class='panel-heading'color = 'red'>$$pro_precio
											<button type='button' pid='$pro_id' id='editar_product' style='float:right;' class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
												<span class='glyphicon glyphicon-edit'></span> Edit
											  </button>
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







	if(isset($_POST["categoria_admin"])){
			
		


		echo "<div class='panel-group'>
		<div class='panel panel-default'>
		  <div class='panel-heading' style='background-color:#d9edf7'>
			<h4 class'panel-title'>
		<a data-toggle='collapse' href='#cat_collapse'>Categorias</a>
		</div>
		<div id='cat_collapse' class='panel-collapse collapse'>
		
		";
		
		$sql = "SELECT * FROM categoria where estado = 1";
		 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
		 $ok   = oci_execute( $stmt );              // Ejecutar la sentencia
		if( $ok == true )
		{
			 if( $obj = oci_fetch_object($stmt) )
			{
				 do
				 {
					$cat_id = $obj->CAT_ID;
					$cat_nombre = $obj->CAT_NOMBRE;
			
					echo " <div class='panel-body' style='height:15px;' > <h6 style='margin-top:-5px;' cid='$cat_id'>$cat_nombre  <button  type='button' cat_id='$cat_id' id='editar_categoria' style='float:right; margin-top:-5px;' class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
					<span class='glyphicon glyphicon-edit'></span>   </button></a></li> </div>";
				 } while( $obj = oci_fetch_object($stmt) );			
			}
			else
				echo "<p>No Hay Libros En Venta</p>";
		}
		else
			$ok = false;
		 oci_free_statement($stmt);   
		 
		echo"</div>
		</div>
	  </div>";
	}





	if(isset($_POST["autor_admin"])){


		           // Ejecutar la sentencia
			 
			 echo "<div class='panel-group'>
			 <div class='panel panel-default'>
			   <div class='panel-heading' style='background-color:#d9edf7'>
				 <h4 class'panel-title'>
			 <a data-toggle='collapse' href='#autor_collapse'>Autores</a>
			 </div>
			 <div id='autor_collapse' class='panel-collapse collapse'>
			 
			 ";			
			 
			 
			 $sql = "SELECT * FROM autor where estado = 1";
		
			 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
			 $ok   = oci_execute($stmt);   
			 if( $ok == true )
			{
				 if( $row = oci_fetch_object($stmt) )
				{
					 do
					 {
					$autor_id = $row->ID;
					$autor_nombres = $row->NOMBRES_Y_APELLIDOS;
					echo "<div class='panel-body' style='height:15px;'> <h6 style='margin-top:-5px;' autor_id='$autor_id'>$autor_nombres   <button type='button' autor_id='$autor_id' id='editar_autor' style='float:right; margin-top:-5px;' class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
					<span class='glyphicon glyphicon-edit'></span>   </button></li> </div>";
					 } while( $row = oci_fetch_object($stmt) );			
				}
				else
					echo "<p>No Hay Editorial Registrado</p>";
			}
			else
				$ok = false;
			 oci_free_statement($stmt); 
			 echo"</div>
</div>
</div>";
		}








		if(isset($_POST["editorial_admin"])){
			$sql = "SELECT * FROM editorial where estado = 1";
			
				 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
				 $ok   = oci_execute($stmt);              // Ejecutar la sentencia
				 
				 echo "<div class='panel-group'>
				 <div class='panel panel-default'>
				   <div class='panel-heading' style='background-color:#d9edf7'>
					 <h4 class'panel-title'>
				 <a data-toggle='collapse' href='#edit_collapse'>Editoriales</a>
				 </div>
				 <div id='edit_collapse' class='panel-collapse collapse'>
				 
				 ";					
				 if( $ok == true )
				{
					 if( $row = oci_fetch_object($stmt) )
					{
						 do
						 {
						$editorial_id = $row->ID;
						$editorial_nombre = $row->NOMBRE;
						echo "<div class='panel-body' style='height:15px;'> <h6 style='margin-top:-5px;' edit_id='$editorial_id'>$editorial_nombre   <button type='button' edit_id='$editorial_id' id='editar_editorial' style='float:right; margin-top:-5px;' class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
						<span class='glyphicon glyphicon-edit'></span>   </button></h6> </div> ";
						 } while( $row = oci_fetch_object($stmt) );			
					}
					else
						echo "<p>No Hay Editorial Registrado</p>";
				}
				else
					$ok = false;
				 oci_free_statement($stmt); 
				 echo"</div>
		</div>
	  </div>";
			}





			if(isset($_POST["escritor_Admin"])){
				$sql = "SELECT * FROM escritor where estado = 1";
				
					 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
					 $ok   = oci_execute($stmt);              // Ejecutar la sentencia
	
	
					 echo "<div class='panel-group'>
				<div class='panel panel-default'>
				  <div class='panel-heading' style='background-color:#d9edf7'>
					<h4 class'panel-title'>
				<a data-toggle='collapse' href='#tipo_collapse'>Tipos De Libros</a>
				</div>
				<div id='tipo_collapse' class='panel-collapse collapse'>
				
				";
					 
					if( $ok == true )
					{
						 if( $row = oci_fetch_object($stmt) )
						{
							 do
							 {
							$escritor_id = $row->ESCRITOR_ID;
							$escritor_nombre = $row->ESCRITOR_NOMBRE;
							echo "<div class='panel-body' style='height:15px;'> <h6 style='margin-top:-5px;' escritor_id='$escritor_id'>$escritor_nombre   <button type='button' esc_id='$escritor_id' id='editar_escritor' style='float:right; margin-top:-5px;' class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
							<span class='glyphicon glyphicon-edit'></span>   </button></a></h6> </div> ";
							 } while( $row = oci_fetch_object($stmt) );			
						}
						else
							echo "<p>No Hay Libros En Venta</p>";
					}
					else
						$ok = false;
					 oci_free_statement($stmt); 
					 echo"</div>
				</div>
			  </div>";
				}