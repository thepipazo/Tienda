<?php 
include "../db.php";
session_start();
if(isset($_POST["getProduct"])){

	$sql = "SELECT * FROM libros ";
	
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
				
				if(isset($_SESSION["uid"]) and $_SESSION['tipo_user'] == 0){
					
				echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_nombre</div>
								<div class='panel-body'>
									<img src='../product_images/$pro_imagen' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$$pro_precio
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Añadir a la cesta</button>
								</div>
							</div>
						</div>	
			";
				
				}else


				echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_nombre</div>
								<div class='panel-body'>
									<img src='product_images/$pro_imagen' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$$pro_precio
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
									
											
											<image type='image' src='../product_images/$pro_imagen'  style='width:199px; height:300px; margin-left:-15px; margin-top:-15px; margin-bottom:-15px;'></image>
											
							
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
							echo "<div class='panel-body' style='height:15px;'> <h6 style='margin-top:-5px;' tipo_id='$escritor_id'>$escritor_nombre   <button type='button' tipo_id='$escritor_id' id='editar_tipo' style='float:right; margin-top:-5px;' class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
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




			if(isset($_POST["editar_categoria"])){
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
			



			if(isset($_POST["editar_editorial"])){
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




			if(isset($_POST["editar_tipo"])){
				$tipo_id = $_POST["tipo_id"];
				$tipo_nombre = "";
				$tipo_descripcion="";
				
				$sql = "SELECT * FROM escritor WHERE escritor_id = $tipo_id";
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				
		
				
			
				if($ok){
			
					if( $obj = oci_fetch_object($run_query) )
					{
						 do
						 {
						
							$tipo_nombre = $obj->ESCRITOR_NOMBRE;
							$tipo_descripcion= $obj->DESCRIPCION;
						
						} while( $obj = oci_fetch_object($run_query) );		
						
					
					}
					else
						echo "<p>No Hay Escritores</p>";
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
			
						  <label for='esc_nombre'>Nombre</label>
						  <input type='text' id='tipo_nombre' name='tipo_nombre' class='form-control' value = $tipo_nombre>
						  
						<label for='esc_desc'>Reseña</label>
						<textarea class='form-control' rows='10' name='tipo_desc' id='tipo_desc' >$tipo_descripcion</textarea>
						</div>
						<div class='modal-footer'>
						<button  style='float:left' tipo_id='$tipo_id' id='before_eliminar_tipo' class='btn btn-danger'>Eliminar</button>
						  <button type='button'  class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
						  <button type='button' tipo_id='$tipo_id' id='actualizar_tipo' style='float:right;'  class='btn btn-primary'>Actualizar</button>
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






			if(isset($_POST["before_eliminar_categoria"])){

				$cat_id = $_POST["cat_id"];

				$sql = "SELECT * FROM libros WHERE libro_cat = $cat_id";
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				$fetc = oci_fetch_object($run_query);
				$num = oci_num_rows($run_query);
			

				if($num > 0){

					echo " 
					<h4 class='text-danger'> Esta Categoria Esta Asociado A un Libro Por Lo Tanto Solo Se Actualizara Su Estado A Inhabilitado</h4>
				  <div class='modal-footer'>
					<button type='button'  style='float:left;' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
					<button type='button'  categoria_id='$cat_id' id='deshabilitar_categoria' style='float'  class='btn btn-primary'>Seguir De Todas Formas</button>
				  </div>";
				}else{
					echo " 
					<h4 class='text-danger'>Esta Categoria Se Eliminara Permanentemente</h4>
				  <div class='modal-footer'>
					<button type='button'  style='float:left;' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
					<button type='button'  categoria_id='$cat_id' id='eliminar_categoria' style='float'  class='btn btn-primary'>Eliminar</button>
				  </div>";

				}
				
			}




			if(isset($_POST["before_eliminar_autor"])){

				$autor_id = $_POST["autor_id"];

				$sql = "SELECT * FROM libros WHERE libro_autor = $autor_id";
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				$fetc = oci_fetch_object($run_query);
				$num = oci_num_rows($run_query);
			

				if($num > 0){

					echo " 
					<h4 class='text-danger'> Este Autor Esta Asociado A un Libro Por Lo Tanto Solo Se Actualizara Su Estado A Inhabilitado</h4>
				  <div class='modal-footer'>
					<button type='button'  style='float:left;' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
					<button type='button' autor_id='$autor_id' id='deshabilitar_autor'  style='float'  class='btn btn-primary'>Seguir De Todas Formas</button>
				  </div>";
				}else{
					echo " 
					<h4 class='text-danger'>Este Autor Se Eliminara Permanentemente</h4>
				  <div class='modal-footer'>
					<button type='button'  style='float:left;' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
					<button type='button'  autor_id='$autor_id' id='eliminar_autor'  style='float'  class='btn btn-primary'>Eliminar</button>
				  </div>";

				}
				
			}




			
			if(isset($_POST["before_eliminar_editorial"])){

				$editorial_id = $_POST["editorial_id"];

				$sql = "SELECT * FROM libros WHERE libro_editorial = $editorial_id";
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				$fetc = oci_fetch_object($run_query);
				$num = oci_num_rows($run_query);
			

				if($num > 0){

					echo " 
					<h4 class='text-danger'> Esta Editoria Esta Asociado A un Libro Por Lo Tanto Solo Se Actualizara Su Estado A Inhabilitado</h4>
				  <div class='modal-footer'>
					<button type='button'  style='float:left;' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
					<button type='button' editorial_id='$editorial_id' id='deshabilitar_editorial'  style='float'  class='btn btn-primary'>Seguir De Todas Formas</button>
				  </div>";
				}else{
					echo " 
					<h4 class='text-danger'>Esta Editorial Se Eliminara Permanentemente</h4>
				  <div class='modal-footer'>
					<button type='button'  style='float:left;' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
					<button type='button' editorial_id='$editorial_id' id='eliminar_editorial'  style='float'  class='btn btn-primary'>Eliminar</button>
				  </div>";

				}
				
			}





			if(isset($_POST["before_eliminar_tipo"])){

				$tipo_id = $_POST["tipo_id"];

				$sql = "SELECT * FROM libros WHERE libro_escr = $tipo_id";
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				$fetc = oci_fetch_object($run_query);
				$num = oci_num_rows($run_query);
			

				if($num > 0){

					echo " 
					
					<h4 class='text-danger'> Este Escritor Esta Asociado A un Libro Por Lo Tanto Solo Se Actualizara Su Estado A Inhabilitado</h4>
				  <div class='modal-footer'>
					<button type='button'  style='float:left;' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
					<button type='button'  tipo_id='$tipo_id' id='deshabilitar_tipo' style='float'  class='btn btn-primary'>Seguir De Todas Formas</button>
				  </div>";
				}else{
					echo " 
					<h4 class='text-danger'>Este Escritor Se Eliminara Permanentemente</h4>
				  <div class='modal-footer'>
					<button type='button'  style='float:left;' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
					<button type='button' tipo_id='$tipo_id' id='eliminar_tipo'  style='float'  class='btn btn-primary'>Eliminar</button>
				  </div>";

				}
				
			}



			if(isset($_POST["eliminar_categoria"])){				
				$categoria_id = $_POST["categoria_id"];
					echo $_POST["eliminar_categoria"]; 

					if($_POST["eliminar_categoria"] == 0){

				$sql = "DELETE from categoria where cat_id = $categoria_id ";

					}elseif($_POST["eliminar_categoria"] == 1){

					$sql = "UPDATE  categoria set estado = 0 where cat_id = $categoria_id ";
				}

				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				
				if($ok){			
					if($_POST["eliminar_categoria"] == 0){	
						echo " 					
						<h4 class='alert alert-success'>Se Elimino Correctamente</h4>
					  <div class='modal-footer'> </div>";
						}else{
							echo " 					
							<h4 class='alert alert-success'>Se Deshabilito Correctamente</h4>
						  <div class='modal-footer'> </div>";
						}
				}else{
					echo " 
					<h4 class='text-danger'>Error Al Eliminar</h4>
				  <div class='modal-footer'>
					
				  </div>";

				}
				
			}



			if(isset($_POST["eliminar_autor"])){
				
				$autor_id = $_POST["autor_id"];

				if($_POST["eliminar_autor"] == 0){
				$sql = "DELETE from autor where id = $autor_id ";
				}elseif($_POST["eliminar_autor"]==1){
				$sql = "UPDATE autor set estado = 0 where id = $autor_id ";
				}
					
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				
				if($ok){			

					if($_POST["eliminar_autor"] == 0){	
					echo " 					
					<h4 class='alert alert-success'>Se Elimino Correctamente</h4>
				  <div class='modal-footer'> </div>";
					}else{
						echo " 					
						<h4 class='alert alert-success'>Se Deshabilito Correctamente</h4>
					  <div class='modal-footer'> </div>";
					}
				}else{

					echo " 
					<h4 class='text-danger'>Error Al Eliminar</h4>
				  <div class='modal-footer'>
					
				  </div>";

				}
				
			}


			if(isset($_POST["eliminar_editorial"])){

				$editorial_id = $_POST["editorial_id"];

				
				if($_POST["eliminar_editorial"] == 0){
					$sql = "DELETE from editorial where id = $editorial_id ";
				}elseif($_POST["eliminar_editorial"] == 1 ){
					$sql = "UPDATE  editorial  set estado = 0 where id = $editorial_id ";
				}

				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				
				if($ok){			
					if($_POST["eliminar_editorial"] == 0){	
						echo " 					
						<h4 class='alert alert-success'>Se Elimino Correctamente</h4>
					  <div class='modal-footer'> </div>";
						}else{
							echo " 					
							<h4 class='alert alert-success'>Se Deshabilito Correctamente</h4>
						  <div class='modal-footer'> </div>";
						}
				}else{
					echo " 
					<h4 class='text-danger'>Error Al Eliminar</h4>
				  <div class='modal-footer'>
					
				  </div>";

				}
				
			}


			if(isset($_POST["eliminar_tipo"])){

				$tipo_id = $_POST["tipo_id"];
			if($_POST["eliminar_tipo"] == 0){
				$sql = "DELETE from escritor where escritor_id = $tipo_id ";
			}elseif($_POST["eliminar_tipo"]==1){
				$sql = "UPDATE  escritor set estado = 0 where escritor_id = $tipo_id ";
			}
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				
				if($ok){			
					if($_POST["eliminar_tipo"]==0){	
						echo " 					
						<h4 class='alert alert-success'>Se Elimino Correctamente</h4>
					  <div class='modal-footer'> </div>";
						}else{
							echo " 					
							<h4 class='alert alert-success'>Se Deshabilito Correctamente</h4>
						  <div class='modal-footer'> </div>";
						}
				}else{
					echo " 
					<h4 class='text-danger'>Error Al Eliminar</h4>
				  <div class='modal-footer'>
					
				  </div>";

				}
				
			}


			if(isset($_POST["editar_product"])){
				$libro_id = $_POST["proId"];
				
				$sql = "SELECT * FROM libros WHERE libro_id = '$libro_id'";
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				
				$precio = 0;
				$stock = 0;
				$reseña = "";
				$nombre = "";
				$escritor_nombre = "";
				$escritor_id=0;
				$categoria_id=0;
				$categoria_nombre="";
				$editorial_id=0;
				$editorial_nombre="";
				$autor_id = 0;
				$autor_nombre = "";
				$palabra="";
				if($ok){
			
					if( $obj = oci_fetch_object($run_query) )
					{
						 do
						 {
						
							$categoria_id = $obj->LIBRO_CAT;
							$escritor_id= $obj->LIBRO_ESCR;
							$nombre = $obj->LIBRO_NOMBRE;
							$precio = $obj->LIBRO_PRECIO;
							$reseña = $obj->LIBRO_DESCR;
							$editorial_id = $obj->LIBRO_EDITORIAL;
							$autor_id = $obj->LIBRO_AUTOR;
							$palabra = $obj->LIBRO_PAL_CLAVE;
							//echo $obj->PRODUCT_IMAGE;
							$pro_imagen = $obj->LIBRO_IMAGEN;
							$stock = $obj->STOCK;
			
						} while( $obj = oci_fetch_object($run_query) );			
					}
					else
						echo "<p>No Hay Libros En Venta</p>";
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
						  <input type='text' id='l_nombre' name='l_nombre' class='form-control' value ='$nombre'>
						  
						<label for='reseña'>Reseña</label>
						<textarea class='form-control' rows='10' name='reseña' id='reseña'>$reseña</textarea>
			
						<label for='escritor'>Escritor</label>
						<select class='form-control' id='l_escritor' name='l_escritor'>
						
					";
								//en esta consulta se pregunta el nombre del escritor actual
						$sql = 'SELECT * FROM escritor';       					
						$runquery = oci_parse($con, $sql);                                  
						$ok = oci_execute($runquery);	
						
						$sql_escritor = "SELECT * FROM escritor where escritor_id = $escritor_id"; 
						$query_escritor = oci_parse($con, $sql_escritor);                                  
						$ok_escritor = oci_execute($query_escritor);
						IF($row_escritor = oci_fetch_object($query_escritor)) {	
							do{
								$escritor_nombre = $row_escritor->ESCRITOR_NOMBRE;
							}while($row_escritor = oci_fetch_object($query_escritor));
						}
						echo "<option value=$escritor_id>$escritor_nombre</option>	";
			
			
			//en esta consulta se pregunta los nombres y el id de los escritores para ponerlos en el combo
			
					   IF($row = oci_fetch_object($runquery)) {							  
						   do{
							   $escritor_id = $row->ESCRITOR_ID;
							echo "<option value = $row->ESCRITOR_ID> $row->ESCRITOR_NOMBRE </option>";
						   }while($row = oci_fetch_object($runquery));         						 
					}	
							
							 oci_free_statement($runquery); 	
				 //----------------------------------------------------------------------
							echo " 	
										
						</select>
			
						 <label for='categoria'>Categoria</label>
						<select class='form-control' id='l_categoria' name='l_categoria'>
						
			
						";
								//en esta consulta se pregunta el nombre de la categoria actual
						$sql = 'SELECT * FROM categoria';       					
						$runquery = oci_parse($con, $sql);                                  
						$ok = oci_execute($runquery);	
						
						$sql_categoria = "SELECT * FROM categoria where cat_id = $categoria_id"; 
						$query_categoria = oci_parse($con, $sql_categoria);                                  
						$ok_escritor = oci_execute($query_categoria);
						IF($row_categoria = oci_fetch_object($query_categoria)) {	
							do{
								$categoria_nombre = $row_categoria->CAT_NOMBRE;
							}while($row_categoria = oci_fetch_object($query_categoria));
						}
						echo "<option value=$categoria_id>$categoria_nombre</option>	";
			
			
			//en esta consulta se pregunta los nombres y el id de los escritores para ponerlos en el combo
			
					   IF($row = oci_fetch_object($runquery)) {							  
						   do{
							   $escritor_id = $row->ESCRITOR_ID;
							echo "<option value = $row->CAT_ID> $row->CAT_NOMBRE </option>";
						   }while($row = oci_fetch_object($runquery));         						 
					}	
							
							 oci_free_statement($runquery); 
					//----------------------------------------------------------------------	
							echo " 	
			
						</select>
			
						<label for='S_Editorial'>Editorial</label>
						<select class='form-control' id='S_Editorial' name='S_Editorial'>
						";
								//en esta consulta se pregunta el nombre de la categoria actual
						$sql = 'SELECT * FROM editorial';       					
						$runquery = oci_parse($con, $sql);                                  
						$ok = oci_execute($runquery);	
						
						$sql_editorial = "SELECT * FROM editorial where ID = $editorial_id"; 
						$query_editorial = oci_parse($con, $sql_editorial);                                  
						$ok_escritor = oci_execute($query_editorial);
						IF($row_editorial = oci_fetch_object($query_editorial)) {	
							do{
								$editorial_nombre = $row_editorial->NOMBRE;
							}while($row_editorial = oci_fetch_object($query_editorial));
						}
						echo "<option value=$editorial_id>$editorial_nombre</option>	";
			
			
			//en esta consulta se pregunta los nombres y el id de los escritores para ponerlos en el combo
			
					   IF($row = oci_fetch_object($runquery)) {							  
						   do{
							   $editorial_id = $row->ID;
							echo "<option value = $row->ID> $row->NOMBRE </option>";
						   }while($row = oci_fetch_object($runquery));         						 
					}	
							
							 oci_free_statement($runquery); 
					//----------------------------------------------------------------------	
							echo " 		
						</select>
			
						<label for='s_autor'>Autor</label>
						<select class='form-control' id='s_autor' name='s_autor'>
						";
								//en esta consulta se pregunta el nombre de la categoria actual
						$sql = 'SELECT * FROM AUTOR';       					
						$runquery = oci_parse($con, $sql);                                  
						$ok = oci_execute($runquery);	
						
						$sql2 = "SELECT * FROM AUTOR where ID = $autor_id"; 
						$query2 = oci_parse($con, $sql2);                                  
						$ok2 = oci_execute($query2);
						IF($row = oci_fetch_object($query2)) {	
							do{
								$autor_nombre = $row->NOMBRES_Y_APELLIDOS;
							}while($row = oci_fetch_object($query2));
						}
						echo "<option value=$autor_id>$autor_nombre</option>	";
			
			
			//en esta consulta se pregunta los nombres y el id de los escritores para ponerlos en el combo
			
					   IF($row = oci_fetch_object($runquery)) {							  
						   do{
							  
							echo "<option value = $row->ID> $row->NOMBRES_Y_APELLIDOS </option>";
						   }while($row = oci_fetch_object($runquery));         						 
					}	
							
							 oci_free_statement($runquery); 
					//----------------------------------------------------------------------	
							echo " 	
						</select>
			
						<label for='l_precio'>precio</label>
						<input type='number' id='l_precio' name='l_precio' class='form-control' value = $precio>
			
						<label for='stock'>stock</label>
						<input type='number' id='stock' name='stock' class='form-control' value = $stock>
			
						<label for='mobile'>Palabra Clave</label>
						<input type='text' id='l_clave' name='l_clave' class='form-control' value = $palabra>
				 
					
				  </div>
				  <div class='modal-footer'>
				  <button  style='float:left' libro_id='$libro_id' id='before_eliminar_libro' class='btn btn-danger'>Eliminar</button>
					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
					<button libro_id='$libro_id' id='actualizar_libro' type='button' class='btn btn-primary'>Actualizar</button>
				  </div>
				</div>
			  </div>
			</div>
						";
			}

			if(isset($_POST["before_eliminar_libro"])){

				$id_libro = $_POST["id_libro"];

				$sql = "SELECT * FROM venta WHERE idlibro = $id_libro";
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				$fetc = oci_fetch_object($run_query);
				$num = oci_num_rows($run_query);
			

				if($num > 0){

					echo " 
					<div class='alert alert-danger' role='alert'>
					Este Libro Esta Asociado A una Venta Por Lo Tanto Solo Se Actualizara Su Estado A Inhabilitado </div> 
				  <div class='modal-footer'>
					<button type='button'  style='float:left;' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
					<button type='button' libro_id='$id_libro' id='deshabilitar_libro'  style='float'  class='btn btn-primary'>Seguir De Todas Formas</button>
				  </div>";

				}else{

					echo " 
					<div class='alert alert-danger' role='alert'>
					Este Libro Se Eliminara Permanentemente
					 </div> 
				  <div class='modal-footer'>
					<button type='button'  style='float:left;' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
					<button type='button' libro_id='$id_libro' id='eliminar_libro'  style='float'  class='btn btn-primary'>Eliminar</button>
				  </div>";
				}
			}

			if(isset($_POST["eliminar_libro"])){

				$libro_id = $_POST["libro_id"];
				if($_POST["eliminar_libro"]==0){
					$sql = "DELETE from libros where libro_id = $libro_id ";
				}elseif($_POST["eliminar_libro"]==1){
					$sql = "UPDATE libros set estado = 0 where libro_id = $libro_id ";

				}
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				
				if($ok){			
					if($_POST["eliminar_libro"] == 0){	
						echo " 					
						<h4 class='alert alert-success'>Se Elimino Correctamente</h4>
					  <div class='modal-footer'> </div>";
						}else{
							echo " 					
							<h4 class='alert alert-success'>Se Deshabilito Correctamente</h4>
						  <div class='modal-footer'> </div>";
						}
				}else{
					echo " 
					<h4 class='text-danger'>Error Al Eliminar</h4>
				  <div class='modal-footer'>
					
				  </div>";

				}
				
			}

			if(isset($_POST["libros_deshabilitados"])){
				
				$sql = "SELECT libro_id,libro_nombre,libro_precio,libro_imagen,(select nombres_y_apellidos from autor where id = libro_autor) as autor FROM libros where estado = 0";
				
					 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
					 $ok   = oci_execute($stmt);          // Ejecutar la sentencia

				echo "  
				<div style='height: 200px; overflow: auto;'>
				<table class='table table-hover' style='font-size:15px'>
				<thead>
      			<tr>
      			 <th>Portada</th>
       			 <th>ID</th>
					<th>Nombre</th>
					<th>Autor</th>
					<th>Precio</th>
					<th>Habilitar</th>
      			</tr>
    			</thead>
  			  <tbody>";
				
				

					if( $ok == true )
					{
						 if( $row = oci_fetch_object($stmt) )
						{
							 do
							 {
							$nombre = $row->LIBRO_NOMBRE;
							$precio = $row->LIBRO_PRECIO;
							$autor = $row->AUTOR;
							$ID = $row->LIBRO_ID;
							$imagen = $row->LIBRO_IMAGEN;
							
							echo "<tr>
							<td><img src='../product_images/$imagen' width='50px' height='60'></td>
							<td>$ID</td>
							<td>$nombre</td>
							<td>$autor</td>
							<td>$precio</td>
							<td> <button type='button' libro_id='$ID' id='habilitar_libros'  class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
							<span class='glyphicon glyphicon-edit'></span>  </button></td>
							  </tr>";
							  
							 } while( $row = oci_fetch_object($stmt) );			
						}
						else
							echo "<p>No Hay Libros Deshabilitados</p>";
					}
					else
						$ok = false;
					 oci_free_statement($stmt); 

					echo"
					 </tbody> 
					 </table>
					 </div>
					 ";exit();
				}

				if(isset($_POST["categorias_deshabilitados"])){

					
					$sql = "SELECT *from categoria where estado = 0";
					$stmt = oci_parse($con, $sql);        // Preparar la sentencia
					$ok   = oci_execute($stmt); 

					echo "  
					<div style='height: 150px; overflow: auto;'>
				<table class='table table-hover'>
				<thead>
      			<tr>
       			<th>ID</th>				
				<th>Nombre</th>		
				<th>Habilitar</th>			
      			</tr>
    			</thead>
  			  <tbody>";
				
					if( $ok  )
				   {
						if( $row = oci_fetch_object($stmt) )
					   {
							do
							{

								
						   $nombre = $row->CAT_NOMBRE;
						   $ID = $row->CAT_ID;
						  
						   
						   echo "<tr>
						   <td>$ID</td>
						   <td>$nombre</td>
						   <td> <button type='button' categoria_id='$ID' id='habilitar_categorias'  class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
						   <span class='glyphicon glyphicon-edit'></span>  </button></td>
							 </tr>";
							 
							} while( $row = oci_fetch_object($stmt) );			
					   }
					   else
						   echo "<p>No Hay Categorias Deshabilitadas</p>";
				   }
				   else
					oci_free_statement($stmt); 

					echo"
					 </tbody> 
					 </table>
					 </div>
					 ";exit();
				}


				if(isset($_POST["autor_deshabilitadoss"])){

					
					$sql = "SELECT *from autor where estado = 0";
					$stmt = oci_parse($con, $sql);        // Preparar la sentencia
					$ok   = oci_execute($stmt); 

					echo "  
					<div style='height: 150px; overflow: auto;'>
				<table class='table table-hover'>
				<thead>
      			<tr>
       			<th>ID</th>				
				<th>Nombre</th>		
				<th>Habilitar</th>			
      			</tr>
    			</thead>
  			  <tbody>";
				
					if( $ok  )
				   {
						if( $row = oci_fetch_object($stmt) )
					   {
							do
							{

								
						   $nombre = $row->NOMBRES_Y_APELLIDOS;
						   $ID = $row->ID;
						  
						   
						   echo "<tr>
						   <td>$ID</td>
						   <td>$nombre</td>
						   <td> <button type='button' autor_id='$ID' id='habilitar_autores'  class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
						   <span class='glyphicon glyphicon-edit'></span>  </button></td>
							 </tr>";
							 
							} while( $row = oci_fetch_object($stmt) );			
					   }
					   else
						   echo "<p>No Hay Autores Deshabilitados</p>";
				   }
				   else
					oci_free_statement($stmt); 

					echo"
					 </tbody> 
					 </table>
				   	</div>
					 ";exit();
				}

				
				if(isset($_POST["editoriales_deshabilitados"])){

					
					$sql = "SELECT *from editorial where estado = 0";
					$stmt = oci_parse($con, $sql);        // Preparar la sentencia
					$ok   = oci_execute($stmt); 

					echo " 
					<div style='height: 150px; overflow: auto;'> 
				<table class='table table-hover'>
				<thead>
      			<tr>
       			<th>ID</th>				
				<th>Nombre</th>	
				<th>Habilitar</th>				
      			</tr>
    			</thead>
  			  <tbody>";
				
					if( $ok  )
				   {
						if( $row = oci_fetch_object($stmt) )
					   {
							do
							{

								
						   $nombre = $row->NOMBRE;
						   $ID = $row->ID;
						  
						   
						   echo "<tr>
						   <td>$ID</td>
						   <td>$nombre</td>
						   <td> <button type='button' editorial_id='$ID' id='habilitar_editoriales'  class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
						   <span class='glyphicon glyphicon-edit'></span>  </button></td>
							 </tr>";
							 
							} while( $row = oci_fetch_object($stmt) );			
					   }
					   else
						   echo "<p>No Hay Editoriales Deshabilitadas</p>";
				   }
				   else
					oci_free_statement($stmt); 

					echo"
					 </tbody> 
					 </table>
					 </div>
					 ";exit();
				}

				if(isset($_POST["tipos_deshabilitados"])){

					
					$sql = "SELECT *from escritor where estado = 0";
					$stmt = oci_parse($con, $sql);        // Preparar la sentencia
					$ok   = oci_execute($stmt); 

					echo "  
					<div style='height: 150px; overflow: auto;'>
				<table class='table table-hover'>
				<thead>
      			<tr>
       			<th>ID</th>				
				<th>Nombre</th>	
				<th>Habilitar</th>				
      			</tr>
    			</thead>
  			  <tbody>";
				
					if( $ok  )
				   {
						if( $row = oci_fetch_object($stmt) )
					   {
							do
							{

								
						   $nombre = $row->ESCRITOR_NOMBRE;
						   $ID = $row->ESCRITOR_ID;
						  
						   
						   echo "<tr>
						   <td>$ID</td>
						   <td>$nombre</td>
						   <td> <button type='button' tipo_id='$ID' id='habilitar_tipos'  class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
						   <span class='glyphicon glyphicon-edit'></span>  </button></td>
							 </tr>";
							 
							} while( $row = oci_fetch_object($stmt) );			
					   }
					   else
						   echo "<p>No Hay Tipos Deshabilitados</p>";
				   }
				   else
					oci_free_statement($stmt); 

					echo"
					 </tbody> 
					 </table>
					 </div>
					 ";exit();
				}

				if(isset($_POST["habilitar_libros"])){

					$libro_id = $_POST["libro_id"];				
					$sql = "update libros set estado = 1 WHERE libro_id = $libro_id";
					$run_query = oci_parse($con,$sql);
					$ok = oci_execute($run_query);
					if($ok){
	
						
						
						echo "<div class='alert alert-success' role='alert'>
						 !Exito Al Habilitar El Libro </div>"; 
					}else{
						echo "<div class='alert alert-danger' role='alert'>
						 !Error Al Habilitar El Libro¡¡ </div>";
	
					}
				}
			


				if(isset($_POST["autor_deshabilitadoss"])){

					
					$sql = "SELECT *from autor where estado = 0";
					$stmt = oci_parse($con, $sql);        // Preparar la sentencia
					$ok   = oci_execute($stmt); 

					echo "  
					<div style='height: 150px; overflow: auto;'>
				<table class='table table-hover'>
				<thead>
      			<tr>
       			<th>ID</th>				
				<th>Nombre</th>		
				<th>Habilitar</th>			
      			</tr>
    			</thead>
  			  <tbody>";
				
					if( $ok  )
				   {
						if( $row = oci_fetch_object($stmt) )
					   {
							do
							{

								
						   $nombre = $row->NOMBRES_Y_APELLIDOS;
						   $ID = $row->ID;
						  
						   
						   echo "<tr>
						   <td>$ID</td>
						   <td>$nombre</td>
						   <td> <button type='button' autor_id='$ID' id='habilitar_autores'  class='btn btn-danger btn-xs' class='btn btn-default btn-sm'>
						   <span class='glyphicon glyphicon-edit'></span>  </button></td>
							 </tr>";
							 
							} while( $row = oci_fetch_object($stmt) );			
					   }
					   else
						   echo "<p>No Hay Autores Deshabilitados</p>";
				   }
				   else
					oci_free_statement($stmt); 

					echo"
					 </tbody> 
					 </table>
				   	</div>
					 ";exit();
				}

				if(isset($_POST["habilitar_categorias"])){

					$categoria_id = $_POST["categoria_id"];				
					$sql = "update categoria set estado = 1 WHERE cat_id = $categoria_id";
					$run_query = oci_parse($con,$sql);
					$ok = oci_execute($run_query);
					if($ok){
	
						
						
						echo "<div class='alert alert-success' role='alert'>
						 !Exito Al Habilitar La categoria Libro </div>"; 
					}else{
						echo "<div class='alert alert-danger' role='alert'>
						 !Error Al Habilitar Categoria Libro</div>";
	
					}
				}

				if(isset($_POST["habilitar_autores"])){

					$autor_id = $_POST["autor_id"];				
					$sql = "update autor set estado = 1 WHERE id = $autor_id";
					$run_query = oci_parse($con,$sql);
					$ok = oci_execute($run_query);
					if($ok){
	
						
						
						echo "<div class='alert alert-success' role='alert'>
						 !Exito Al Habilitar El Autor </div>"; 
					}else{
						echo "<div class='alert alert-danger' role='alert'>
						 !Error Al Habilitar El Autor </div>";
	
					}
				}

				if(isset($_POST["habilitar_editoriales"])){

					$editorial_id = $_POST["editorial_id"];				
					$sql = "update editorial set estado = 1 WHERE id = $editorial_id";
					$run_query = oci_parse($con,$sql);
					$ok = oci_execute($run_query);
					if($ok){
	
						
						
						echo "<div class='alert alert-success' role='alert'>
						 !Exito Al Habilitar La Editorial </div>"; 
					}else{
						echo "<div class='alert alert-danger' role='alert'>
						 !Error Al Habilitar La Editorial </div>";
	
					}
				}

				if(isset($_POST["habilitar_tipos"])){

					$tipo_id = $_POST["tipo_id"];				
					$sql = "update escritor set estado = 1 WHERE escritor_id = $tipo_id";
					$run_query = oci_parse($con,$sql);
					$ok = oci_execute($run_query);
					if($ok){
	
						
						
						echo "<div class='alert alert-success' role='alert'>
						 !Exito Al Habilitar El Tipo De Libro </div>"; 
					}else{
						echo "<div class='alert alert-danger' role='alert'>
						 !Error Al Habilitar El Tipo De Libro</div>";
	
					}
				}

				if(isset($_POST["actualizar_categoria"])){
					$categoria_id = $_POST["id_cat"];
					$nuevo_nombre = $_POST["nombre_nuevo_categoria"];
					$nueva_descripcion = $_POST["descripcion_categoria"];
					
					
	
					if(trim($nueva_descripcion) == "" ||  trim($nuevo_nombre) == ""){
						echo "<div class='alert alert-danger' role='alert'>
						 !Error, Verifique Que Todos Los Campos No Esten Vacios¡¡ </div>"; exit();
	
					}else{
	
						
					$sql = "update categoria set cat_nombre = upper('$nuevo_nombre'), cat_descripcion = '$nueva_descripcion' WHERE cat_id = $categoria_id";
					$run_query = oci_parse($con,$sql);
					$ok = oci_execute($run_query);
					if($ok){
	
						
						
						echo "<div class='alert alert-success' role='alert'>
						 !Exito Al Actualizar El Escritor¡¡ </div>"; 
					}else{
						echo "<div class='alert alert-danger' role='alert'>
						 !Error Al Actualizar El Escritor¡¡ </div>";
	
					}
				}
			
				}

if(isset($_POST["actualizar_autor"])){


	$autor_id = $_POST["id_autor"];
	$nuevo_nombre = $_POST["nombre_nuevo_autor"];
	$nueva_descripcion = $_POST["descripcion_autor"];
	
	

	if(trim($nueva_descripcion) == "" ||  trim($nuevo_nombre) == ""){
		echo "<div class='alert alert-danger' role='alert'>
		 !Error, Verifique Que Todos Los Campos No Esten Vacios¡¡ </div>"; exit();

	}else{

		
	$sql = "update autor set nombres_y_apellidos = upper('$nuevo_nombre'), descripcion = '$nueva_descripcion' WHERE id = $autor_id";
	$run_query = oci_parse($con,$sql);
	$ok = oci_execute($run_query);
	if($ok){

		
		
		echo "<div class='alert alert-success' role='alert'>
		 !Exito Al Actualizar El Escritor¡¡ </div>"; 
	}else{
		echo "<div class='alert alert-danger' role='alert'>
		 !Error Al Actualizar El Escritor¡¡ </div>";

	}}}



	if(isset($_POST["actualizar_editorial"])){


		$editorial_id = $_POST["id_edit"];
		$nuevo_nombre = $_POST["nombre_nuevo_editorial"];
		$nueva_descripcion = $_POST["descripcion_editorial"];
		
		

		if(trim($nueva_descripcion) == "" ||  trim($nuevo_nombre) == ""){
			echo "<div class='alert alert-danger' role='alert'>
			 !Error, Verifique Que Todos Los Campos No Esten Vacios¡¡ </div>"; exit();

		}else{

			
		$sql = "update editorial set nombre = upper('$nuevo_nombre'), descripcion = '$nueva_descripcion' WHERE id = $editorial_id";
		$run_query = oci_parse($con,$sql);
		$ok = oci_execute($run_query);
		if($ok){

			
			
			echo "<div class='alert alert-success' role='alert'>
			 !Exito Al Actualizar El Escritor¡¡ </div>"; 
		}else{
			echo "<div class='alert alert-danger' role='alert'>
			 !Error Al Actualizar El Escritor¡¡ </div>";

		}}}


		if(isset($_POST["actualizar_tipo"])){
			$tipo_id = $_POST["id"];
			$nuevo_nombre_tipo = $_POST["nombre_nuevo_tipo"];
			$nueva_descripcion_escritor = $_POST["descripcion_nuevo_tipo"];
			
			

			if(trim($nueva_descripcion_escritor) == "" ||  trim($nuevo_nombre_tipo) == ""){
				echo "<div class='alert alert-danger' role='alert'>
				 !Error, Verifique Que Todos Los Campos No Esten Vacios¡¡ </div>"; exit();

			}else{

				
			$sql = "update escritor set escritor_nombre = upper('$nuevo_nombre_tipo'), descripcion = '$nueva_descripcion_escritor' WHERE escritor_id = $tipo_id";
			$run_query = oci_parse($con,$sql);
			$ok = oci_execute($run_query);
			if($ok){

				
				
				echo "<div class='alert alert-success' role='alert'>
				 !Exito Al Actualizar El Tipo De Libro¡ </div>"; 
			}else{
				echo "<div class='alert alert-danger' role='alert'>
				 !Error Al Actualizar El Tipo De Libro¡¡ </div>";
			}}}


		if(isset($_POST["actualizar_libros"])){


			$nombre = $_POST["nombre"];
			$reseña = $_POST["reseña"];
			
			$escritor = $_POST["escritor"];
			$categoria = $_POST["categoria"];
			$editorial = $_POST["editorial"];
			$autor = $_POST["autor"];
			$precio = $_POST["precio"];
			$stok = $_POST["stok"];
			$palabra = $_POST["palabra"];
			$id_libro = $_POST["id"];
			

			if(trim($nombre) == "" ||  trim($reseña) == "" ||  trim($escritor) == "" ||  trim($categoria) == "" ||  trim($editorial) == "" ||  trim($editorial) == "" ||  trim($autor) == "" ||  trim($precio) == "" ||  trim($stok) == "" ||  trim($palabra) == "" ){
				echo "<div class='alert alert-danger' role='alert'>
				 !Error, Verifique Que Todos Los Campos No Esten Vacios¡¡ </div>"; exit();

			}else{

				
			$sql = "update libros set libro_cat = '$categoria',
			 libro_escr = '$escritor',
			 libro_nombre = '$nombre',
			 libro_precio = '$precio',
			 libro_descr = '$reseña',
			 libro_pal_clave = '$palabra',
			 stock = '$stok',
			 libro_editorial = '$editorial',
			 libro_autor = '$autor' WHERE libro_id = $id_libro";
			$run_query = oci_parse($con,$sql);
			$ok = oci_execute($run_query);
			if($ok){

				
				
				echo "<div class='alert alert-success' role='alert'>
				 !Exito Al Actualizar El Escritor¡¡ </div>"; 
			}else{
				echo "<div class='alert alert-danger' role='alert'>
				 !Error Al Actualizar El Escritor¡¡ </div>";

			}
		}
	
		}

		if(isset($_POST["tipo"])){
			$sql = "SELECT * FROM escritor";
			
				 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
				 $ok   = oci_execute($stmt);              // Ejecutar la sentencia
			echo "<div class='nav nav-pills nav-stacked'><li class='active'><a href='#'><h4>Tipo de Libro</h4></a></li>";
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