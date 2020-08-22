<?php 
include "../db.php";
session_start();
if(isset($_POST["getProduct"])){
 	$url = $_POST["urlp_cli"];
	$sql = "SELECT * FROM libros where estado = 1 ";
	
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
				$descuento = $obj->DESCUENTO;
				$total_descuento = ($pro_precio*$descuento)/100;
				$nuevo_precio = ($pro_precio-$total_descuento);

				
				$msg_precio = "";
				$msg_principal = "";
				$msg ="";
				//<input  style='width:160px; height:250px;' type='button'  id='mymodal' name='mymodal'src='product_images/$pro_imagen' >
				if($pro_stock == 0){
					$msg = "<small style='color:red;'> No Disponible &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small> ";
					
				}else{
					$msg = "<small style='color:green;'> Disponible &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small> ";
				}

				if($descuento == 0){
				$msg_precio=	"<span class='font-weight-bold d-block'>$ $pro_precio</span>";

				}else{
					$msg_precio = "<div class='bbb_viewed_price'>$$nuevo_precio<span>$$pro_precio</span></div>";
					$msg_principal = "<ul class='item_marks' ><li class='item_mark item_discount' style='display:block; width:55px; height:55px; margin-left:-36px;'> <a style='position:absolute; margin-top:8px; font-size:19px; margin-left:-25px;'> -$descuento%</a></li>
					</ul>";
				}

				if(isset($_SESSION["uid"]) and $_SESSION['tipo_user'] == 0){
					
					echo "
					<div class='col-md-4'>
					<div class='card p-4' style='margin-bottom:15px'>

				

						<div class='text-center' > <image  libro='$pro_id' id='producto_mostrar' role='button' src='$url/$pro_imagen'  style='width:150px; height:200px; '></image> </div>

						$msg_principal

						<div class='product-details'> 
								$msg_precio
							<span role='button' libro='$pro_id' id='producto_mostrar'>$pro_nombre</span>
							<div class='buttons d-flex flex-row'>
								<div class='cart'><i class='fa fa-shopping-cart'></i></div> <button proId='$pro_id' id='agregar_producto' style='width: 198px;text-align: center;	padding-top: 0px;' class='btn btn-success'><span class='dot'>1</span>Agregar al carro </button>
							</div>
					<div class='weight' > $msg  $pro_stock/U  </div>
					
					
							
						</div>
					</div>
				</div>
				";
				
				}else{


					echo "
					<div class='col-md-4'>
					<div class='card p-4' style='margin-bottom:15px'>

				

						<div class='text-center' > <image type='image' src='$url/$pro_imagen'  style='width:150px; height:200px; '></image> </div>

						$msg_principal

						<div class='product-details'> 
								$msg_precio
							<link>$pro_nombre</link>
							<div class='buttons d-flex flex-row'>
								<div class='cart'><i class='fa fa-shopping-cart'></i></div> <button proId='$pro_id' id='agregar_producto_sin_registrar' style='width: 198px;text-align: center;	padding-top: 0px;' class='btn btn-success'><span class='dot'>1</span>Agregar al carro </button>
							</div>
					<div class='weight' > $msg  $pro_stock/U  </div>
					
					
							
						</div>
					</div>
				</div>
				";
				}
			
                        
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






if(isset($_POST["categorias_cli"])){
	$sql = "SELECT * FROM categoria where estado = 1";
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
				echo "<a role='button' id='buscar_categorias' catid='$cid'>$cat_nombre</a>";
			 } while( $obj = oci_fetch_object($stmt) );			
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
									
											
											<image type='image' src='../../product_images/$pro_imagen'  style='width:199px; height:300px; margin-left:-15px; margin-top:-15px; margin-bottom:-15px;'></image>
											
							
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
							<td><img src='../../product_images/$imagen' width='50px' height='60'></td>
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

		if(isset($_POST["tipo_cli"])){
			$sql = "SELECT * FROM escritor";
			
				 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
				 $ok   = oci_execute($stmt);        
				       // Ejecutar la sentencia
					 
					   
					   if( $ok == true )
					   {
					if( $row = oci_fetch_object($stmt) ){
						 do
						 {
								$tipo_id = $row->ESCRITOR_ID;
								$tipo_nombre = $row->ESCRITOR_NOMBRE;
								echo "<a  role='button' id='buscar_tipo' tipoid='$tipo_id'>$tipo_nombre</a>";

						 } while( $row = oci_fetch_object($stmt) );			
					}
					else
						echo "<p>No Hay Tipos de Libros</p>";
				}
				else	
								
				 				oci_free_statement($stmt); 

						   
			}

			if(isset($_POST["autor_cli"])){
				
				
				$sql = "SELECT * FROM autor where estado = 1";
				 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
				 $ok   = oci_execute( $stmt );              // Ejecutar la sentencia
				if( $ok == true )
				{
					 if( $obj = oci_fetch_object($stmt) )
					{
						 do
						 {
							$autorid = $obj->ID;
							$autor_nombre = $obj->NOMBRES_Y_APELLIDOS;
		
							echo "<a  role='button' id='buscar_autor' autorid='$autorid'>$autor_nombre </a>";
			
						} while( $obj = oci_fetch_object($stmt));	
						
					}else
						echo "<p>No Hay Autores</p>";
				}else
					 oci_free_statement($stmt);    	
				 
				}


			if(isset($_POST["editorial_cli"])){
				
				$sql = "SELECT * FROM editorial";
				 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
				 $ok   = oci_execute( $stmt );              // Ejecutar la sentencia
				if( $ok == true )
				{
					 if( $obj = oci_fetch_object($stmt) )
					{
						 do
						 {
							$editorialid = $obj->ID;
							$editorial_nombre = $obj->NOMBRE;
							echo "<a style='font-size:12px' role='button' id='buscar_editorial' editid='$editorialid'>$editorial_nombre</a>";

						} while( $obj = oci_fetch_object($stmt) );			
					}
					else
						echo "<p>No Hay Editoriales</p>";
				}
				else
					$ok = false;
				 oci_free_statement($stmt);    	
				 echo"</div>
				 </div>
				 </div>";   
			}


			if(isset($_POST["categoria_cli_seleccionada"]) || isset($_POST["tipo_cli_seleccionada"]) || isset($_POST["autor_cli_seleccionada"]) || isset($_POST["editorial_cli_seleccionada"]) || isset($_POST["buscador_cli"])){
				
				$url = $_POST["url2"];

				if(isset($_POST["categoria_cli_seleccionada"])){
					$id = $_POST["cat_id"];
					$sql = "SELECT * FROM libros WHERE libro_cat = '$id' and estado = 1";
				}else if(isset($_POST["tipo_cli_seleccionada"])){
					$id = $_POST["tipoid"];
					$sql = "SELECT * FROM libros WHERE libro_escr = '$id' and estado = 1";
				}else if(isset($_POST["autor_cli_seleccionada"])){

					$autor_id  = $_POST["autor_id"];
					$sql = "SELECT * FROM libros WHERE libro_autor = '$autor_id' and estado = 1";
					
					
				}else if(isset($_POST["editorial_cli_seleccionada"])){
					$editorial_id = $_POST["editid"];
					$sql = "SELECT * FROM libros WHERE libro_editorial = '$editorial_id' and estado = 1";

				}else if(isset($_POST["buscador_cli"])){
					
					if(trim($_POST["buscador_cli"]) == ""){
						$sql = "SELECT * FROM libros";

				}else{
					$buscador_cliente = $_POST["buscador_cliente"];
					$sql = "SELECT * FROM libros WHERE libro_pal_clave LIKE '%$buscador_cliente%'";
					}
				}
				
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
							$pro_imagen = $obj->LIBRO_IMAGEN;
							$pro_stock = $obj->STOCK;
							$descuento = $obj->DESCUENTO;
							$total_descuento = ($pro_precio*$descuento)/100;
							$nuevo_precio = ($pro_precio-$total_descuento);

							if($pro_stock == 0){
								$msg = "<small style='color:red;'> No Disponible &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small> ";
								
							}else{
								$msg = "<small style='color:green;'> Disponible &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</small> ";
							}


				$msg_precio = "";
				$msg_principal = "";
				$msg ="";
				

				if($descuento == 0){
				$msg_precio=	"<span class='font-weight-bold d-block'>$ $pro_precio</span>";

				}else{
					$msg_precio = "<div class='bbb_viewed_price'>$$nuevo_precio<span>$$pro_precio</span></div>";
					$msg_principal = "<ul class='item_marks' ><li class='item_mark item_discount' style='display:block; width:55px; height:55px; margin-left:-36px;'> <a style='position:absolute; margin-top:8px; font-size:19px; margin-left:-25px;'> -$descuento%</a></li>
					</ul>";
				}
			
				if(isset($_SESSION["uid"]) and $_SESSION['tipo_user'] == 0){
					
					echo "
					<div class='col-md-4'>
					<div class='card p-4' style='margin-bottom:15px'>

				

						<div class='text-center' > <image  libro='$pro_id' id='producto_mostrar' role='button' src='$url/$pro_imagen'  style='width:150px; height:200px; '></image> </div>

						$msg_principal

						<div class='product-details'> 
								$msg_precio
							<span role='button' libro='$pro_id' id='producto_mostrar'>$pro_nombre</span>
							<div class='buttons d-flex flex-row'>
								<div class='cart'><i class='fa fa-shopping-cart'></i></div> <button proId='$pro_id' id='agregar_producto' style='width: 198px;text-align: center;	padding-top: 0px;' class='btn btn-success'><span class='dot'>1</span>Agregar al carro </button>
							</div>
					<div class='weight' > $msg  $pro_stock/U  </div>
					
					
							
						</div>
					</div>
				</div>
				";
				
				}else{


					echo "
					<div class='col-md-4'>
					<div class='card p-4' style='margin-bottom:15px'>

				

						<div class='text-center' > <image type='image' src='$url/$pro_imagen'  style='width:150px; height:200px; '></image> </div>

						$msg_principal

						<div class='product-details'> 
								$msg_precio
							<link>$pro_nombre</link>
							<div class='buttons d-flex flex-row'>
								<div class='cart'><i class='fa fa-shopping-cart'></i></div> <button proId='$pro_id' id='agregar_producto_sin_registrar' style='width: 198px;text-align: center;	padding-top: 0px;' class='btn btn-success'><span class='dot'>1</span>Agregar al carro </button>
							</div>
					<div class='weight' > $msg  $pro_stock/U  </div>
					
					
							
						</div>
					</div>
				</div>
				";
				}
				   
						   
						} while( $obj = oci_fetch_object($stmt) );			
				   }
				   else
					   echo "<p>No hay nada que mostrar</p>";
			   }
			   else
				   $ok = false;
				oci_free_statement($stmt);  
			
				}


				if(isset($_POST["actualizar_cliente"])){
					
					$user_id = $_POST["id_user"];	
					$rut = $_POST["rut"];	
					$nombres = $_POST["nombres"];			
					$apellidos = $_POST["apellidos"];	
					$password = md5($_POST["password"]);	
					$correo = $_POST["correo"];	
					$telefono = $_POST["telefono"];	
					$direccion = $_POST["direccion"];	
					
					
	
					if(trim($rut) == "" ||  trim($nombres) == "" ||  trim($apellidos) == "" ||  trim($password) == "" ||  trim($correo) == "" ||  trim($telefono) == "" ||  trim($correo) == ""){
						echo "<div class='alert alert-danger' role='alert'>
						 !Error, Verifique Que Todos Los Campos No Esten Vacios¡¡ </div>"; exit();
	
					}else{
	
						
					$sql = "update user_info set rut = '$rut', nombres = '$nombres', apellidos = '$apellidos', email = '$correo', password = '$password', telefono = $telefono, direccion = '$direccion' WHERE user_id = $user_id";
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
				oci_free_statement($run_query);  
				}

				if(isset($_POST["registrar"])){
					
				$rut = $_POST["rut"];
				$f_name = $_POST["nombres"];
				$l_name = $_POST["apellidos"];
				$email = $_POST["correo"];
				$password = $_POST['password'];
				$repassword = $_POST['repassword'];
				$mobile = $_POST['telefono'];
				$address1 = $_POST['direccion'];


				$titular = $_POST['titular'];
				$numero_targeta = $_POST['numero_targeta'];
				$cvv = $_POST['cvv'];
				$fecha1 = $_POST['fecha1'];
				$fecha2 = $_POST['fecha2'];

				

				$name = "/^[A-Z][a-zA-Z ]+$/";
				$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
				$number = "/^[0-9]+$/";
				
				if(empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($repassword) 
				|| empty($mobile) || empty($address1)){
						
						//en caso de que este vacio	
						echo 1;						
						exit();

					} else {
				
					if(!preg_match($emailValidation,$email)){
						//en caso de que el correo no sea valido
						echo 2;
						exit();
					}
					if(strlen($password) < 9 ){
						//en caso de que la password sea debil
						echo 3;
						exit();
					}
					
					if($password != $repassword){
						//en caso de que las contraseña no sean iguales
						echo 4;
						exit();
					}
					if(!preg_match($number,$mobile)){
						//en caso de que el numero no sean solo numeros
						echo 5;
						exit();
					}
					if(strlen($mobile) < 9){
						//en caso de que el numero sea muy corto
						echo 6;
						exit();
					}
					//en caso de que el correo existe
					$sql = "SELECT user_id FROM user_info WHERE email = '$email' " ;					
					$run_query = oci_parse($con,$sql);
					$ok = oci_execute($run_query);
					$row = ocI_fetch_object($run_query);
					$count = oci_num_rows($run_query);
					
					//if($ok == true){
					if($count > 0){
						echo 7;
						exit();
					}

						$password = md5($password);
						$sql = "INSERT INTO user_info VALUES (null, '$f_name', '$l_name', '$email', '$password', '$mobile', '$address1', 0,'$rut',0)";
						$run_query = oci_parse($con,$sql);

							//en caso de que los datos de la targeta esten vacios
							if((empty($titular) and empty($numero_targeta) and empty($cvv)) and empty($fecha1) and empty($fecha2))
							{
								$ok = oci_execute($run_query);

								if($ok){
									echo 9;
									exit();
								}else{
									echo 10;
									exit();
								}
								
					
							//en caso de que los datos de la targeta esten llenos
							}elseif(trim($titular) != "" and trim($numero_targeta) != "" and trim($cvv) != "" and trim($fecha1) != "" and trim($fecha2) != "")
							{
							
							
								$sql2 = "INSERT INTO modo_pago VALUES (null, '$titular', $numero_targeta, '$fecha1/$fecha2',(SELECT  user_id from (select * from user_info order by user_info.user_id desc )where rownum = 1))";
								$run_query2 = oci_parse($con,$sql2);
									
								$ok = oci_execute($run_query);
								

								if($ok)
								{

									$ok2 = oci_execute($run_query2);

									if($ok2)
									{
										echo 9;
										exit();
									}else
									{
										echo 11;
										exit();
									}	
								
								}else{
									echo 10;
									exit();
								}
	
							}else{//en caso de que los datos de la targeta esten inconpletos
								echo 8;
								exit();
							}
							
						
				}
				}
					
					


					if(isset($_POST["agregar_producto"])){
		
						if(isset($_SESSION["uid"])){
						$libro_id = $_POST["proId"];
						$user_id = $_SESSION["uid"];
						$sql = "SELECT * FROM carro WHERE libro_id = '$libro_id' AND user_id = '$user_id'";
						$run_query = oci_parse($con,$sql);
						$ok = oci_execute($run_query);
						$obj = oci_fetch_object($run_query);
						$count = oci_num_rows($run_query);
						oci_free_statement($run_query);
						
						if($count > 0){
							
							echo "
								<div class='alert alert-warning' style='text-align:center;'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<b>El producto ya está agregado al carrito Continuar comprando..!</b>
								</div>
							";
						} else {
							 
							
							
							$sql = "SELECT * FROM libros WHERE libro_id = '$libro_id'";
							$run_query = oci_parse($con,$sql);
							$ok = oci_execute($run_query);
							$row = oci_fetch_object($run_query);
							$num = oci_num_rows($run_query);
							oci_free_statement($run_query);
							
								$id = $row->LIBRO_ID;
								$stock = $row->STOCK;
								$libro_nombre = $row->LIBRO_NOMBRE;
								$imagen_libro = $row->LIBRO_IMAGEN;
								$libro_precio = $row->LIBRO_PRECIO;
								$descuento = $row->DESCUENTO;

								$total_descuento = ($libro_precio*$descuento)/100;
								$nuevo_precio = ($libro_precio-$total_descuento);

							

								if($stock > 0){

							$sql = "INSERT INTO carro VALUES (NULL, $libro_id, '0', $user_id, '$libro_nombre', '$imagen_libro', '1', $libro_precio, $nuevo_precio,$descuento,$total_descuento)";
							$run_query = oci_parse($con,$sql);
							$ok = oci_execute($run_query);
							oci_free_statement($run_query);

									$stock = $stock-1;
							$sql = "UPDATE libros set STOCK = $stock where libro_id = $id";
							$run_query = oci_parse($con,$sql);
							$ok2 = oci_execute($run_query);
							oci_free_statement($run_query);

							if($ok == true and $ok2 == true){
								echo "
									<div class='alert alert-success' style='text-align:center;'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<b>Producto agregado..!</b>
									</div>
								";
							}else{
								
							}						
						}else{//en caso de que no hay stock
							echo "
							<div class='alert alert-danger' style='text-align:center;'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<b>No hay stock del producto..!</b>
							</div>
						";
						}
					}
						//si no esta logeado
						}else{
							echo "
									<div class='alert alert-danger' style='text-align:center;'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<b>Para Agregar Productos Primero Debe Iniciar Sesion..!!</b>
									</div>
								";
						}						
					}			

					if( isset($_POST["carro_de_compras"])){

						
						
						$uid = $_SESSION["uid"];
						$sql = "SELECT * FROM carro WHERE user_id = '$uid'";
						$run_query = oci_parse($con,$sql);
						$ok = oci_execute($run_query);

						$rows = oci_parse($con,$sql);
						$rows2 = oci_execute($rows);
						$rows3 = oci_fetch_all($rows, $res);
						if($rows3 > 0){
						
							$no = 1;
							$total_amt = 0;
							$total=0;
							if($ok){

									echo "
										<div class='col align-self-center text-right text-muted' styl>$rows3 items</div>
									";
							
							while($row=oci_fetch_object($run_query)){
										
								$id = $row->ID;
								$libro_id = $row->LIBRO_ID;
								$libro_name = $row->NOMBRE_LIBRO;
								$libro_image = $row->IMAGEN_LIBRO;
								$cant = $row->QTY;
								$precio = $row->PRECIO;
								$total = $row->TOTAL_AMT;	
								$descuento = $row->DESCUENTO;
								$msg_precio ="";	

								$sin_descuento =0;
								$sin_descuento = $precio*$cant;

							
								

								if($descuento==0){

							
								$msg_precio = "<div class='col'> <a id='precio$libro_id' >$$total </a>";

								}else{
							
								$msg_precio = "<div class='bbb_viewed_price' style='width:200px;margin-left:-23px;' > <a id='precio$libro_id' > $$total </a> <span id='precio_anterior'>$$sin_descuento</span></div> ";
								
								}
								


								setcookie("ta",$total_amt,strtotime("+1 day"),"/","","",TRUE);
									echo"
											<div class='row border-top border-bottom'>
												<div class='row main align-items-center'>
													<div class='col-2'><img class='img-fluid' src='../../product_images/$libro_image'></div>
													<div class='col'>
														<div class='row text-muted' style='width: 129px;'>$libro_name</div>
														<div class='row'>ID: #$libro_id</div>
													</div>
													<div class='col-md-3' style='margin-left: -48px;'> <span precio='$precio' role='button' libro = '$libro_id' id='menos_cant'>-</span> <input id='contador$libro_id' type='text' style='width:45px; height:20px; margin-top:35px' value='$cant'disabled='true'> <span role='button' precio='$precio' libro='$libro_id' id='mas_cant'>+</span> </div>
													
													$msg_precio

													<span role='button' style='width:0px' cantidad='$cant' class='close'  proId='$libro_id' id='eliminar_carro_id' >X</span> </div>
												</div>
											</div>											
										";
								$no = $no + 1;											
									}
						}
					}else{
						echo 1;
					}
					}

					if(isset($_POST["modo_pago"])){
						$uid = $_SESSION["uid"];
						$sql = "SELECT * FROM carro WHERE user_id = '$uid'";
						$run_query = oci_parse($con,$sql);
						$ok = oci_execute($run_query);
						$total = 0;
						$total_ahorro=0;
						

						$rows = oci_parse($con,$sql);
						$rows2 = oci_execute($rows);
						$rows3 = oci_fetch_all($rows, $res);
						if($ok){

						while($row=oci_fetch_object($run_query)){							
								
							$id = $row->ID;
							$libro_id = $row->LIBRO_ID;
							$libro_name = $row->NOMBRE_LIBRO;
							$ahorro = $row->AHORRO;
							$precio = $row->PRECIO;
							$total = $total+$row->TOTAL_AMT;
							$total_ahorro=$total_ahorro+$ahorro;	
							//$total_amt = $total + $total_sum;
						}
						echo"
					<h5><b>Detalles Del Pedido</b></h5>
					</div>
					<hr>
					<div class='row'>
						<div class='col' style='padding-left:0;''>Productos $rows3</div>
						<div class='col text-right'>$$total</div>
					</div>
					<form>
						<p>Medio De Pago</p> <select>";

						$sql2 = "SELECT*FROM modo_pago where usuario = $uid";
						$run_query2 = oci_parse($con,$sql2);
						$ok2 = oci_execute($run_query2);
						if($ok2){									
							while($row = oci_fetch_object($run_query2)){	
								do{
									
									$numero_targeta = $row->NUMERO_TARGETA;
									$num_corto = substr($numero_targeta, 0 , 4);
									echo "<option class='text-muted'> $num_corto-xxxx-xxxx-xxxx</option>";
								}while($row = oci_fetch_object($run_query2));
							

							}
						}

						
							echo"									
						</select>
						
						<div class='row' style='border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;''>
							<div class='col' style='margin-right: -5px;'>Descuento total:</div>
							<div class='col text-right'>$$total_ahorro</div>
						</div>
					</form>
					<div class='row' style='border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;''>
						<div class='col'>Total A Pagar</div>
						<div class='col text-right'>$$total</div>
					</div>";

					if($_POST["value"]==0){
						echo "<button class='btn btn-primary' id='pagar_pedido' style='background-color:#535e6b; border-color:#0f1419; width:262px; display:none' >Pagar</button>";

					}else{
						echo"
						<button class='btn btn-primary' id='pagar_pedido' style='background-color:#535e6b; border-color:#0f1419; width:262px;' >Pagar</button>";
					}						
										}
	}

	
	if(isset($_POST["eliminar_de_carro"])){
		$stok = 0;
		$lid = $_POST["proId"];
		$uid = $_SESSION["uid"];
		$cantidad = $_POST["cantidad"];

		$sql = "SELECT*FROM libros  WHERE libro_id = '$lid'";
		$run_query = oci_parse($con,$sql);
		$ok = oci_execute($run_query);
		if($ok){
			while($row = oci_fetch_object($run_query)){
				$stok = $row->STOCK;
				$stok = $stok + $cantidad;
			}
		
		$sql2 = "UPDATE libros set stock = $stok where libro_id = '$lid'";
		$run_query2 = oci_parse($con,$sql2);
		$ok2 = oci_execute($run_query2);
		
			$sql = "DELETE FROM carro WHERE user_id = '$uid' AND libro_id = '$lid'";
			$run_query = oci_parse($con,$sql);
			$ok = oci_execute($run_query);
			
		
				if($ok == false){
					echo "
						<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Error Al Quitar El Producto Del Carro!</b>
						</div>
						";	
								}
		
		
			}								
	}



	if(isset($_POST["pagar_pedido"])){
	$contador=1;
	$ahorros_totales=0;
	$id = 0;
	$total_compra=0;
	$uid = $_SESSION["uid"];
	$sql = "SELECT * FROM carro WHERE user_id = '$uid'";
	$qery_carro = oci_parse($con,$sql);
	$ok = oci_execute($qery_carro);
	
	//oci_free_statement($run_query);
	
	
	$sql2 = "INSERT into detalleventa values (null,0,sysdate,$uid,sysdate + 7,0)";
	$run_query2 = oci_parse($con,$sql2);
	$ok2 = oci_execute($run_query2);
	//oci_free_statement($run_query2);
	
	
	if($ok == true){
	  $seq = "Select IDDETALLE from (select * from DETALLEVENTA order by DETALLEVENTA.IDDETALLE desc )where rownum = 1 ";
	  $run_query4 = oci_parse($con,$seq);
	  $ok4 = oci_execute($run_query4);
	  $rows = oci_fetch_object($run_query4);
	  $id = $rows->IDDETALLE;
	  
	
	 
	
	while($row=oci_fetch_object($qery_carro)){
		
	  $idlibro = $row->LIBRO_ID;
	  $total = $row->TOTAL_AMT;
	  $cantidad = $row->QTY;
	  $descuento = $row->DESCUENTO;
	  $total_compra = $total_compra+$total;
	  $ahorro = $row ->AHORRO;
	  $ahorros_totales = $ahorros_totales+$ahorro;
	 
	  $_SESSION['iddetalle']=$id;
	  
	  $fecha = date('Y-m-j');
	  $nuevafecha = strtotime ( '+5 day' , strtotime ( $fecha ) ) ;
	  $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
	  $_SESSION['fecha']=$nuevafecha;
	
	  $query = OCIParse($con, "begin AGREGAR_VENTA2(:id_libro,:total,:cantidad_de_libro,:iddetalle,:descuento,:MENSAJE); end;");
	  oci_bind_by_name($query, ':ID_LIBRO',$idlibro);
	  oci_bind_by_name($query, ':TOTAL',$total);
	  oci_bind_by_name($query, ':CANTIDAD_DE_LIBRO',$cantidad);
	  oci_bind_by_name($query, ':IDDETALLE',$id);
	  oci_bind_by_name($query, ':DESCUENTO',$descuento);
	  oci_bind_by_name($query, ':MENSAJE',$mensaje,100);
	 //echo $seq;
	 if ( $sp = @oci_execute($query)){
	

	 }else{
	
	  //echo "malo";
	 }
	
	
	 $sql = "UPDATE detalleventa set total_compra = $total_compra, total_Ahorro = $ahorros_totales where iddetalle = $id";
	 $run_query = oci_parse($con,$sql);
	 $ok = oci_execute($run_query);
	
	$query = OCIParse($con, "begin eliminar_carro(:LIBRO_ID2, :USER_ID2); end;");
	oci_bind_by_name($query, ':LIBRO_ID2', $idlibro);
	oci_bind_by_name($query, ':USER_ID2',$uid);
	$sp = @oci_execute($query);
	
	
		
	$contador++;
		
	}
	//header("location:perfil_usuario.php");
	echo "<IMG SRC='../../product_images/correcto.png' style='width:200px;margin-left:32%;margin-top:15%;'>";

	}else{
		echo "noooo";
	}

	}





	if(isset($_POST["stock_mas_carro"])){
		$id_libro  = $_POST["libro"];
		$user = $_SESSION['uid'];
		$sql = "SELECT stock FROM libros WHERE libro_id = $id_libro";
		$run_query = oci_parse($con,$sql);
		$ok = oci_execute($run_query);

		if($ok){
			while($row = oci_fetch_object($run_query)){
				$stock = $row->STOCK;
				
				if($stock > 0){
				
					$stock = $stock-1;
					$sql = "UPDATE libros SET stock = $stock  WHERE libro_id = $id_libro";
					$run_query = oci_parse($con,$sql);
					$ok = oci_execute($run_query);
					if($ok){
						echo 1;exit();
					}
					
				}else{
					echo "sin stock";exit();
				}
			}			
		}
	}


if(isset($_POST["sumar_cant_carro"])){
		$cantidad = 0;
		$precio = $_POST["precio"];
		$id_libro  = $_POST["libro"];
		$user = $_SESSION['uid'];
		$sql = "SELECT*FROM CARRO WHERE user_id = $user and libro_id = $id_libro";
		$run_query = oci_parse($con,$sql);
		$ok = oci_execute($run_query);

		if($ok){
			while($row = oci_fetch_object($run_query)){
					$cant = $row->QTY;
					$ahorro = $row->AHORRO;
					$cantidad = $cant+1;
					$descuento = $row->DESCUENTO;

				
				

					$sql2 = "UPDATE carro set qty = $cantidad where user_id = $user and libro_id = $id_libro";
					$run_query2 = oci_parse($con,$sql2);
					$ok2 = oci_execute($run_query2);
						if($ok2)
						{	

							$total_descuento = ($precio*$descuento)/100;
							$total = ($precio-$total_descuento);
							$total = $total*$cantidad;

							$ahorro = $ahorro+$total_descuento;

							
								
										
									
									$sql3 = "UPDATE carro set total_amt= $total, ahorro = $ahorro where user_id = $user and libro_id = $id_libro";
									$run_query3 = oci_parse($con,$sql3);
									$ok3 = oci_execute($run_query3);

								if($ok3)
								{
								exit();
								}
						}
			}
		}
}



if(isset($_POST["stock_menos_carro"])){
	$id_libro  = $_POST["libro"];
	$user = $_SESSION['uid'];
	$sql = "SELECT stock FROM libros WHERE libro_id = $id_libro";
	$run_query = oci_parse($con,$sql);
	$ok = oci_execute($run_query);

	if($ok){
		while($row = oci_fetch_object($run_query)){
			$stock = $row->STOCK;			
			
			
				$stock = $stock+1;
				$sql = "UPDATE libros SET stock = $stock  WHERE libro_id = $id_libro";
				$run_query = oci_parse($con,$sql);
				$ok = oci_execute($run_query);
				if($ok){
					echo 1;exit();
				}
				
			
		}			
	}
}


	
if(isset($_POST["restar_cant_carro"]))
{
	$cantidad = 0;
	$precio = $_POST["precio"];
	$id_libro  = $_POST["libro"];
	$user = $_SESSION['uid'];
	$sql = "SELECT*FROM CARRO WHERE user_id = $user and libro_id = $id_libro";
	$run_query = oci_parse($con,$sql);
	$ok = oci_execute($run_query);

	if($ok)
	{
		while($row = oci_fetch_object($run_query))
		{
				$cant = $row->QTY;
				$cantidad = $cant-1;
				$ahorro = $row->AHORRO;
				$descuento = $row->DESCUENTO;

			if($cantidad >= 1)
			{

				$sql2 = "UPDATE carro set qty = $cantidad where user_id = $user and libro_id = $id_libro";
				$run_query2 = oci_parse($con,$sql2);
				$ok2 = oci_execute($run_query2);
					if($ok2)
					{	


						$total_descuento = ($precio*$descuento)/100;
						$total = ($precio-$total_descuento);
						$total = $total*$cantidad;
						$ahorro = $ahorro-$total_descuento;

						

								$sql3 = "UPDATE carro set total_amt= $total, ahorro = $ahorro where user_id = $user and libro_id = $id_libro";
								$run_query3 = oci_parse($con,$sql3);
								$ok3 = oci_execute($run_query3);

							if($ok3)
							{
								exit();
							}
					}
			}
		}
	}
}






	if(isset($_POST["listar_libros_para_ofertar"])){
			$id="";
			$sql ="";
		if($_POST["listar_libros_para_ofertar"]==1){
			$id="mandar_libros_a_oferta";
			$sql = "SELECT descuento,libro_id,libro_nombre,libro_precio,libro_imagen,(select nombres_y_apellidos from autor where id = libro_autor) as autor FROM libros where descuento = 0";

		}elseif($_POST["listar_libros_para_ofertar"]==2){
			$id="quitar_libro_ofertado";

			$sql = "SELECT descuento,libro_id,libro_nombre,libro_precio,libro_imagen,(select nombres_y_apellidos from autor where id = libro_autor) as autor FROM libros where descuento > 0";

		}
	
		 $stmt = oci_parse($con, $sql);        // Preparar la sentencia
		 $ok   = oci_execute($stmt);          // Ejecutar la sentencia

	echo "  
	<div style='height: 600px; overflow: auto;'>
	<table class='table table-hover' style='font-size:15px'>
	<thead>
	  <tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Autor</th>
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
				$autor = $row->AUTOR;
				$ID = $row->LIBRO_ID;
				$descuento = $row->DESCUENTO;
				if($_POST["listar_libros_para_ofertar"]==1){
					$precio = $row->LIBRO_PRECIO;

				}elseif($_POST["listar_libros_para_ofertar"]==2){
					$precio = $row->LIBRO_PRECIO;
					$total_descuento = ($precio*$descuento)/100;
					$precio_nuevo = ($precio-$total_descuento);
				}

				
				
				echo "<tr>
				<td>$ID</td>
				<td>$nombre</td>
				<td>$autor</td>
				";
				if($_POST["listar_libros_para_ofertar"]==1){
					echo"
					<td> 
					<button type='button' descuento_libro='$descuento' precio='$precio' libro_id='$ID' id='$id'  class='btn btn-danger btn-xs'>
						<span class='glyphicon glyphicon-edit'></span>  
					</button>
				</td>
				</tr>";

				}if($_POST["listar_libros_para_ofertar"]==2){

					echo "
					<td> 
					<button type='button' precio_nuevo='$precio_nuevo'  descuento_libro='$descuento' precio='$precio' libro_id='$ID' id='$id'  class='btn btn-danger btn-xs'>
						<span class='glyphicon glyphicon-edit'></span>  
					</button>
				</td>
				</tr>";

				}
				 
				  
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






	if(isset($_POST["carruse_ofertas"])){

		echo "
	<div class='bbb_viewed_slider_container'>
		<div class='owl-carousel owl-theme bbb_viewed_slider owl-loaded owl-drag'>
		";

			$sql = "SELECT*from libros where descuento != 0";			
			$run_query = oci_parse($con,$sql);
			$ok = oci_execute($run_query);
			$url = "";
	
			if($ok){
				while($row = oci_fetch_object($run_query)){
					$precio = $row->LIBRO_PRECIO;
					$nombre = $row->LIBRO_NOMBRE;
					$ID = $row->LIBRO_NOMBRE;
					$imagen = $row->LIBRO_IMAGEN;
					$descuento = $row->DESCUENTO;

					$total_descuento = ($precio*$descuento)/100;
					$nuevo_precio = ($precio-$total_descuento);

					if(isset($_SESSION["uid"]) and $_SESSION['tipo_user'] == 0){
						$url = "../../product_images";
					}else{
						$url = "product_images";
					
				}

					echo"
				<div class='owl-item cloned' style='width: 150px;  margin-right: 30px;'>
				<div class='owl-item'>
					<div class='bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center'>
						<div class='bbb_viewed_image'><img style='height:140px;' src='$url/$imagen' alt=''></div>
						<div class='bbb_viewed_content text-center'>
						<div class='bbb_viewed_price'>$$nuevo_precio<span>$$precio</span></div>
						<div class='bbb_viewed_name'><a href='#'>$nombre</a></div>
					</div>
					<ul class='item_marks' >
						<li class='item_mark item_discount' style='display:block; width:55px; height:55px; margin-left:-36px;'> <a style='position:absolute; margin-top:8px; font-size:19px; margin-left:-25px;'> -$descuento%</a></li>
					</ul>
				</div>
				</div>
			</div>";
				}

			}

			

		echo"
		</div>
	</div>";

	}





	if(isset($_POST["poner_en_oferta"])){
		$libro = $_POST["libro"];
		$descuento = $_POST["descuento"];

		
				$sql = "UPDATE libros set descuento = $descuento where  libro_id = $libro";
				$run_query = oci_parse($con,$sql);	
				
				$ok = oci_execute($run_query);
					if($ok){
						echo "<div class='alert alert-success' role='alert'>
						!Se Actualizo El Precio Correctamente¡¡ </div>"; 
					}else{
						echo $sql;
					}
	}



	if(isset($_POST["producto_solo"])){
	
		$libro = $_POST["libro"];
		$sql = "SELECT*FROM libros where  libro_id = $libro";
		$run_query = oci_parse($con,$sql);					
		$ok = oci_execute($run_query);
		$nombre="";
		$portada ="";
		$precio=0;
		$nuevo_precio=0;
		$descuento=0;
		$reseña="";
		$editorial=0;
		$autor=0
;		if($ok){		
			while($row = oci_fetch_object($run_query)){
				$nombre = $row->LIBRO_NOMBRE;
				$portada = $row->LIBRO_IMAGEN;
				$precio = $row->LIBRO_PRECIO;
				$descuento = $row->DESCUENTO;
				$reseña = $row->LIBRO_DESCR;
				$autor = $row->LIBRO_AUTOR;
				$editorial = $row->LIBRO_EDITORIAL;
				$pro_stock = $row->STOCK;

				$total_descuento = ($precio*$descuento)/100;
				$nuevo_precio = ($precio-$total_descuento);
			}
		}else{
			$nombre=$libro;
		}

		$sql = "SELECT*FROM autor where  ID = $autor";
		$run_query = oci_parse($con,$sql);					
		$ok = oci_execute($run_query);
		if($ok){
			while($row = oci_fetch_object($run_query)){
				$autor = $row->NOMBRES_Y_APELLIDOS;
			}
		}


		$sql = "SELECT*FROM editorial where  ID = $editorial";
		$run_query = oci_parse($con,$sql);					
		$ok = oci_execute($run_query);
		if($ok){
			while($row = oci_fetch_object($run_query)){
				$editorial = $row->NOMBRE;
			}
		}

		if($pro_stock == 0){
			$msg = "<small style='color:red;'> No Disponible &emsp;&emsp;&emsp;</small> ";
			
		}else{
			$msg = "<small style='color:green;'> Disponible &emsp;&emsp;&emsp;</small> ";
		}
		
		echo "
			<div class='modal fade' id='exampleModal2'  tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle'  aria-hidden='true'>
			  <div class='modal-dialog' role='document' style='margin-right: 50%;'>
				<div class='modal-content' style='width: 1000px; margin-right:500px'>
				  <div class='modal-header'>
					<div id='msg_actualizado' </div>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
					  <span aria-hidden='true'>&times;</span>
					</button>
					<div id='msg_actualizado' </div>
				  </div>
				  <div class='modal-body'>





		 <div class='row'>
                
		<div class='col-lg-4 order-lg-2 order-1'>
			<div class='image_selected'><img src='../../product_images/$portada' style='width: 600px;' alt=''></div>
		</div>
		<div class='col-lg-6 order-3' style='margin-left:5%;width: 50%;' >
		<div id='agregar_product_solo'></div>
			<div class='product_description2'>
			
				<div class='product_name2'>
						$nombre 
				</div>
				<div class='product-rating2'>
					<span class='badge2 badge2-success'><i class='fa fa-pencil fa-1x'></i>Autor: $autor</span> 
					<span class='badge2 badge2-success' ><i class='fa fa-text-width fa-1x'></i>Editorial:  $editorial</span>
					
				</div>";
				
				if($descuento >0){
					echo"
						<div>
							<span class='product_price2'>$ $nuevo_precio</span>
								<strike class='product_discount2'>
							<span style='color:black'>$ $precio </span>
								</strike> 		
								<span style='color:red;'>-$descuento%</span>
						<div>";
				}else{
					echo"
						<div>
							<span class='product_price2'>$ $precio</span>													
						<div>";
				}
				echo "
				
				</div>
					<hr class='singleline2'>
					
				<div> 
					<span>$reseña</span>
				</div>
			<div>
			</div>
			
		</div>
					<hr class=singleline2'>

					<div> $msg  $pro_stock/U  </div>

			<div class='order_info d-flex flex-row'>
				<form action='#'>
				</form>
			</div>
				<div class='row' style='float:center'>
				  <button class='btn btn-success' proId='$libro' id='agregar_producto_directo' style='width: 200px;'> Aagregar Al Carro</button>					
				</div>
			</div>
		</div>

				</div>
				  <div class='modal-footer'>
				  </div>
			
			";exit();

	}







	if(isset($_POST["mostrar_clientes"])){
		$rut = $_POST["rut"];
		if($rut != 0){
		
			$sql="SELECT*FROM user_info where uer_admin != 1 and rut = $rut";
			echo $sql;exit();
		}else{
			$sql="SELECT*FROM user_info where uer_admin != 1";
			echo $sql;exit();
		}
		$query = oci_parse($con,$sql);
		$ok = oci_execute($query);
		echo"  
		<div style='height: 600px; overflow: auto;'>
		<table class='table table-hover' style='font-size:15px'>
		<thead>
		  <tr>
			<th>ID</th>
			<th>NOMBRES</th>
			<th>APELLIDOS</th>
			<th>EMAIL</th>
			<th>TELEFONO</th>
			<th>DIRECCION</th>
			<th>RUT</th>
			<th>ESTADO</th>
		  </tr>
		</thead>
		<tbody>";
		
		
	
			if( $ok == true )
			{
				 while( $ROW = oci_fetch_object($query) )
				{
					 
						 $ID = $ROW->USER_ID;
						 $NOMBRES = $ROW->NOMBRES;
						 $APELLIDOS = $ROW->APELLIDOS;
						 $EMAIL = $ROW->EMAIL;
						 $TELEFONO = $ROW->TELEFONO;
						 $DIRECCION = $ROW->DIRECCION;
						 $RUT = $ROW->RUT;
						 $ESTADO = $ROW->ESTADO;

						if($ESTADO==0){
							$ESTADO = "
							<button type='button' pid='410' id='banear_usuario' user_id='$ID' class='btn btn-success btn-xs'>ACTIVO</button>
							";
						}else{
							$ESTADO = "
							<button type='button' pid='410' id='habilitar_usuario' user_id_baned='$ID' class='btn btn-danger btn-xs'>INACTIVO</button>
							";
						}
					
					
					echo "<tr>
							<td>$ID</td>
							<td>$NOMBRES</td>
							<td>$APELLIDOS</td>
							<td>$EMAIL</td>
							<td>$TELEFONO</td>
							<td>$DIRECCION</td>
							<td>$RUT</td>
							<td>$ESTADO</td>
						<tr>
					";
	
				
					 
					  
					 
				}
				
			}
			else
				$ok = false;
			 oci_free_statement($query); 
	
			echo"
			 </tbody> 
			 </table>
			 </div>
			 ";exit();
	}




	if(isset($_POST["ban_desban"])){			
		$usuario = $_POST["user"];
		$sql = "";
		$msg="";
		if($_POST["ban_desban"] == 1){
			$sql = "UPDATE user_info set estado = 1 where  user_id = $usuario";
			$msg="<div class='alert alert-warning' role='alert'>!Se Baneo El Usuario Correctamente¡¡ </div>";
		}elseif($_POST["ban_desban"] == 0){
			$sql = "UPDATE user_info set estado = 0 where  user_id = $usuario";
			$msg="<div class='alert alert-success' role='alert'>!Se Habilito El Usuario Correctamente¡¡ </div>";
		}
		$run_query = oci_parse($con,$sql);
		$ok = oci_execute($run_query);

					if($ok){
					echo $msg; exit();
					}else{
						echo $sql;
					}
	}
