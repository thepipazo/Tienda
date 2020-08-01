<?php

include "../../db.php";
?>

<?php
include "../../menus/admin.php";
?>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="nuevolibro_msg">
		
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Formulario de registro de libro</div>
					<div class="panel-body">
					
					<form name="formPrueba" method="post" enctype="multipart/form-data" id="formPrueba" action="../../controlador/subir_libro.php">
            		<div class="row">
                    
                   
				<div class="col-md-8">
								<label for="f_name">Nombre</label>
								<input type="text" id="l_nombre" name="l_nombre" class="form-control">
				</div>
				<div class="col-md-3" >
                           		<label for="categoria">Categoria</label>
                            	<select class="form-control" id="l_categoria" name="l_categoria">
    							<option value="0">Seleccione:</option>
        					<?php
							
							$sql = "SELECT * FROM CATEGORIA";
        					$runquery = oci_parse($con, $sql);                                  
							$ok = oci_execute($runquery);	
							
						
 
  						 if($row = oci_fetch_object($runquery)) {
							  
							   do{
								echo "<option value =".$row->CAT_ID.">$row->CAT_NOMBRE</option>";
							   }while($row = oci_fetch_object($runquery));
         						 
						}
 								
 
 								oci_free_statement($runquery);
 								     
							?>
 							</select>
							</ul>
						</li>
							
				</div>
				<div class="col-md-1">
							<label for="escritor"></label>
							<a href="nuevo_categoria.php" class="btn btn-info" style="width: 1px;margin-top: 24px;margin-left: -25px;"><span class="glyphicon glyphicon-plus" style="right: 6px;"></span></a>
							</div>
			</div>
			
			<div class="row">
							<div class="col-md-12">
								<label for="reseña">Reseña</label>
								<textarea class="form-control" rows="10" name="reseña" id="reseña"></textarea>
							</div>
						</div>
			<div class="row">
			
                    <div class="row" style="margin-top:5px;">

                        </div>
							<div class="col-md-3">
								<label for="escritor">Tipo</label>
								<select class="form-control" id="l_escritor" name="l_escritor">
								<option value="0">Seleccione:</option>								
        					<?php							
							$sql = "SELECT * FROM escritor";       					
        					$runquery = oci_parse($con, $sql);                                  
							$ok = oci_execute($runquery);														
 
  						 IF($row = oci_fetch_object($runquery)) {							  
							   do{
								echo "<option value =".$row->ESCRITOR_ID.">$row->ESCRITOR_NOMBRE</option>";
							   }while($row = oci_fetch_object($runquery));         						 
						}	
 								 
 								oci_free_statement($runquery); 								     
							?>
 							</select>
							
							</div>	
							<div class="col-md-1">
								<label for="escritor"></label>
								<a href="nuevo_escritor.php" class="btn btn-info" style="width: 1px;margin-top: 24px;margin-left: -25px;"><span class="glyphicon glyphicon-plus" style="right: 6px;"></span></a>
							</div>

							<div class="col-md-3">
								<label for="S_Editorial">Editorial</label>
								<select class="form-control" id="S_Editorial" name="S_Editorial">
								<option value="Vacio">Seleccione:</option>	
								<?php							
							$sql = "SELECT * FROM editorial";       					
        					$runquery = oci_parse($con, $sql);                                  
							$ok = oci_execute($runquery);														
 
  						 IF($row = oci_fetch_object($runquery)) {							  
							   do{
								echo "<option value =".$row->ID.">$row->NOMBRE</option>";
							   }while($row = oci_fetch_object($runquery));         						 
						}	
 								 
 								oci_free_statement($runquery); 								     
							?>
								</select>
							</div>
							<div class="col-md-1">
								<label for=""></label>
								<a href="nuevo_editorial.php" class="btn btn-info" style="width: 1px;margin-top: 24px;margin-left: -25px;"><span class="glyphicon glyphicon-plus" style="right: 6px;"></span></a>
							</div>
							
							<div class="col-md-3">
								<label for="s_autor">Autor</label>
								<select class="form-control" id="s_autor" name="s_autor">
								<option value="vacio">Seleccione:</option>	
								<?php							
							$sql = "SELECT * FROM autor";       					
        					$runquery = oci_parse($con, $sql);                                  
							$ok = oci_execute($runquery);														
 
  						 IF($row = oci_fetch_object($runquery)) {							  
							   do{
								echo "<option value =".$row->ID.">$row->NOMBRES_Y_APELLIDOS</option>";
							   }while($row = oci_fetch_object($runquery));         						 
						}	
 								 
 								oci_free_statement($runquery); 								     
							?>

								</select>
							</div>
							<div class="col-md-1">
								<label for="autor"></label>
								<a href="nuevo_autor.php" class="btn btn-info" style="width: 1px;margin-top: 24px;margin-left: -25px;"><span class="glyphicon glyphicon-plus" style="right: 6px;"></span></a>
							</div>

						
						</div>
					</div>	

				<div class ="row" style="margin-left: 4px; margin-right: 5px;">
					<div>
						<div class="col-md-4">
								<label for="repassword">precio</label>
								<input type="number" id="l_precio" name="l_precio" class="form-control" placeholder="$0">
						</div>

						<div class="col-md-4">
								<label for="repassword">stock</label>
								<input type="number" id="stock" name="stock" class="form-control" placeholder="0">
						</div>

						<div class="col-md-4">
								<label for="mobile">Palabra Clave</label>
								<input type="text" id="l_clave" name="l_clave" class="form-control">
						</div>

					</div>
				</div>

					<div>
				<div class="col-md-4">
    				
				 		<label for="archivo">Subir Caratula</label>
						 <input id="imagen" name="imagen"type="file" accept="image/*" onchange="loadFile(event)"  class="form-control-file">
						 <img name="portada" id="portada" width="160" height="250"/>
							<script>
  								var loadFile = function(event) {
    							var reader = new FileReader();
    							reader.onload = function(){
      							var output = document.getElementById('portada');
      							output.src = reader.result;
    							};
    							reader.readAsDataURL(event.target.files[0]);
  								};
							</script>
				 		
				 	
				</div>
			</div>
						
		 	<div class="row">
			 

						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
							
								<input style="float:right;" value="Registrar" type="submit" id="nuevolibro" name="nuevolibro"  class="btn btn-primary upload">
							</div>
						</div>
						
					</div>
					</form>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>



















