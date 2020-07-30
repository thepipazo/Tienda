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


				if(isset($_POST["ingresar_categoria"])){
	

					$cat_nombre = $_POST["ingresar_categoria"];
					$cat_descripcion = $_POST["cat_descripcion"];
					$estado = 1;
			
					if($cat_nombre == ""){
						echo "
						<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b> Campo Vacio!!</b>
						</div>
					";
					exit();
					}
					
				if($con){
			
					$query = OCIParse($con, "begin AGREGAR_CATEGORIA(:nombre,:descripcion,:estado,:mensaje); end;");
					oci_bind_by_name($query, ':nombre', $cat_nombre);
					oci_bind_by_name($query, ':descripcion', $cat_descripcion);
					oci_bind_by_name($query, ':estado',$estado);
					oci_bind_by_name($query, ':mensaje',$mensaje,100);
					
					$sp = @oci_execute($query);
			
				
			
					oci_free_statement($query);
					//Se cierra la conexión
					oci_close($con);
			
					
						echo "
						<div class='alert alert-success'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>$mensaje</b>
						</div>
					
					";
					}else{
						
						
						echo "
						<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Error Al Conectar Con La Base De Datos></div></b>
						</div>";
					}		
					}



					if(isset($_POST["ingresotipo"])){
	
						$escritor_nombre = $_POST["escritornombre"];
						$escritor_descripcion = $_POST["descripcion"];
						$estado=1;
						if($escritor_nombre == ""){
							echo "
							<div class='alert alert-warning'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<b> Campo Vacio!!</b>
							</div>
						";
						exit();
						}
						
						/*$sql = "INSERT into escritor values (null,'$escritor_nombre')";
						$run_query = oci_parse($con,$sql);
						$ok = oci_execute($run_query);*/
			
			
						$query = OCIParse($con, "begin agregar_escritor(:nombre,:descripcion,:estado); end;");
						oci_bind_by_name($query, ':nombre', $escritor_nombre);
						oci_bind_by_name($query, ':descripcion', $escritor_descripcion);
						oci_bind_by_name($query, ':estado', $estado);
			
						$sp = @oci_execute($query);
						
						if($sp == true){
							echo "
							<div class='alert alert-success'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Se ingreso Con Exito !!</b>
							</div>
						";
						}else{
							echo "
								<div class='alert alert-success'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<b> Error desconocido !!</b>
								</div>
							";
							exit();
						}
						
						
						}






				
	

	if(isset($_POST["ingreso_autor"])){
	
		$nombre_completo = $_POST["nombre"];
		$descripcion = $_POST["descripcion"];
		
		if($nombre_completo == ""){
			echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b> Campo Vacio!!</b>
			</div>
		";
		exit();
		}
		
		$sql = "INSERT into autor values (null,'$nombre_completo','$descripcion',1)";
		$run_query = oci_parse($con,$sql);
		$ok = oci_execute($run_query);
	
		
		if($ok == true){
			echo "
			<div class='alert alert-success'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>Se ingreso Con Exito !!</b>
			</div>
		";
		}else{
			echo "
				<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b> Error desconocido !!</b>
				</div>
			";
			exit();
		}
		
		
		}




		if(isset($_POST["ingreso_editorial"])){
	
			$nombre = $_POST["nombre"];
			$descripcion = $_POST["descripcion"];
			
			if($nombre == ""){
				echo "
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b> Campo Vacio!!</b>
				</div>
			";
			exit();
			}
			
			$sql = "INSERT into editorial values (null,'$nombre','$descripcion',1)";
			$run_query = oci_parse($con,$sql);
			$ok = oci_execute($run_query);
		
			
			if($ok == true){
				echo "
				<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Se ingreso Con Exito !!</b>
				</div>
			";
			}else{
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b> Error desconocido !!</b>
					</div>
				";
				exit();
			}	
			
			}




			if(isset($_POST["editar_autor"])){//esta funcion es para mostrar un menu de categorias para el administrador donde tendra la posibilidad de editar
				$autor_id = $_POST["autor_id"];
				$autor_nombre = "";
				$autor_descripcion="";
				
				$sql = "SELECT * FROM autor WHERE id = $autor_id";
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				
			
				if($ok){
			
					if( $obj = oci_fetch_object($run_query) )
					{
						 do
						 {
						
							$autor_nombre = $obj->NOMBRES_Y_APELLIDOS;
							$autor_descripcion= $obj->DESCRIPCION;
						
						} while( $obj = oci_fetch_object($run_query) );		
						
					
					}
					else
						echo "<p>No Hay categorias</p>";
				}
				else{
				echo "Error con la base de datos";
					$ok = false;
				 oci_free_statement($run_query);  
				}  
			
				echo "
				<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
	  <div class='modal-dialog' role='document'>
		<div class='modal-content'>
		  <div class='modal-header'>
			<h5 class='modal-title' id='exampleModalLongTitle'>Formulario Para Actualizar Libros</h5>
			<div id='msg_actualizado' </div>
			<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
			  <span aria-hidden='true'>&times;</span>
			</button>
			<div id='msg_actualizado' </div>
		  </div>
		  <div class='modal-body'>
			
						  <label for='autor_nombre'>Nombre</label>
						  <input type='text' id='autor_nombre' name='autor_nombre' class='form-control' value = '$autor_nombre'>
						  
						<label for='reseña_autor'>Reseña</label>
						<textarea class='form-control' rows='10' name='reseña_autor' id='reseña_autor'>$autor_descripcion</textarea>
						</div>
						<div class='modal-footer'>
						<button  style='float:left' autor_id ='$autor_id' id='before_eliminar_autor' class='btn btn-danger'>Eliminar</button>
						  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
						  <button autor_id ='$autor_id' id='actualizar_autor' type='button' class='btn btn-primary'>Actualizar</button>
						</div>
					  </div>
					</div>
				  </div>
						"; 
						exit();
			}




			if(isset($_POST["editar_categoria"])){//esta funcion es para mostrar un menu de categorias para el administrador donde tendra la posibilidad de editar
				$cat_id = $_POST["c_id"];
				$cat_nombre = "";
				$cat_descripcion="";
				
				$sql = "SELECT * FROM categoria WHERE cat_id = $cat_id";
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				
		
				
			
				if($ok){
			
					if( $obj = oci_fetch_object($run_query) )
					{
						 do
						 {
						
							$cat_nombre = $obj->CAT_NOMBRE;
							$cat_descripcion= $obj->CAT_DESCRIPCION;
						
						} while( $obj = oci_fetch_object($run_query) );		
						
					
					}
					else
						echo "<p>No Hay categorias</p>";
				}
				else{
				echo "Error con la base de datos";
					$ok = false;
				 oci_free_statement($run_query);  
				}  
			
				echo "
				<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
	  <div class='modal-dialog' role='document'>
		<div class='modal-content'>
		  <div class='modal-header'>
			<h5 class='modal-title' id='exampleModalLongTitle'>Formulario Para Actualizar Libros</h5>
			<div id='msg_actualizado' </div>
			<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
			  <span aria-hidden='true'>&times;</span>
			</button>
			<div id='msg_actualizado' </div>
		  </div>
		  <div class='modal-body'>
			
						  <label for='f_name'>Nombre</label>
						  <input type='text' id='cat_nombre' name='cat_nombre' class='form-control' value = $cat_nombre>
						  
						<label for='cat_reseña'>Reseña</label>
						<textarea class='form-control' rows='10' name='cat_reseña' id='cat_reseña'>$cat_descripcion</textarea>
						</div>
						<div class='modal-footer'>
						<button  style='float:left' cat_id='$cat_id' id='before_eliminar_categoria' class='btn btn-danger'>Eliminar</button>
						  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
						  <button  cat_id='$cat_id'  id='actualizar_cat' type='button' class='btn btn-primary'>Actualizar</button>
						</div>
					  </div>
					</div>
				  </div>
						"; 
						exit();
			
				
				
			}
			



			if(isset($_POST["editar_editorial"])){//esta funcion es para mostrar un menu de categorias para el administrador donde tendra la posibilidad de editar
				$editorial_id = $_POST["editorial_id"];
				$editorial_nombre = "";
				$editorial_descripcion="";
				
				$sql = "SELECT * FROM EDITORIAL WHERE id = $editorial_id";
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				
		
				
			
				if($ok){
			
					if( $obj = oci_fetch_object($run_query) )
					{
						 do
						 {
						
							$editorial_nombre = $obj->NOMBRE;
							$editorial_descripcion= $obj->DESCRIPCION;
						
						} while( $obj = oci_fetch_object($run_query) );		
						
					
					}
					else
						echo "<p>No Hay categorias</p>";
				}
				else{
				echo "Error con la base de datos";
					$ok = false;
				 oci_free_statement($run_query);  
				}  
			
				echo "
				<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
	  <div class='modal-dialog' role='document'>
		<div class='modal-content'>
		  <div class='modal-header'>
			<h5 class='modal-title' id='exampleModalLongTitle'>Formulario Para Actualizar Libros</h5>
			<div id='msg_actualizado' </div>
			<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
			  <span aria-hidden='true'>&times;</span>
			</button>
			<div id='msg_actualizado' </div>
		  </div>
		  <div class='modal-body'>
			
						  <label for='f_name'>Nombre</label>
				 		  <input type='text' id='edit_nombre' name='edit_nombre' class='form-control' value = $editorial_nombre>
						  
						<label for='reseña'>Reseña</label>
						<textarea class='form-control' rows='10' name='reseña_edit' id='reseña_edit'>$editorial_descripcion</textarea>
						</div>
						<div class='modal-footer'>
						<button  style='float:left' edit_id ='$editorial_id' id='before_eliminar_editorial' class='btn btn-danger'>Eliminar</button>
						  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
						  <button type='button' edit_id ='$editorial_id' id='actualizar_edit' class='btn btn-primary'>Actualizar</button>
						</div>
					  </div>
					</div>
				  </div>
						"; 
						exit();
			
				
				
			}






















			if(isset($_POST["getPedidos"])){
				
						
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
							
							
							echo "
								<div class='col-md-4'>
											<div class='panel panel-info'>
												<div class='panel-heading'>$pro_nom25bre</div>
												<div class='panel-body'>
													<img src='product_images/$pro_imagesadn' style='width:160px; height:250px;'/>
												</div>
												<div class='panel-heading'>$pro_precio
												
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

			if(isset($_POST["awa"])){
			
				echo "
				<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b> Error desconocido !!</b>
				</div>
			";
			exit();
			}



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
			


			if(isset($_POST["category"])){
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