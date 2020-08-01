
<?php
include("../../menus/cliente.php");
?>
<?php
include("../../db.php");
$id_usuario=$_SESSION["uid"];
$rut="";
$nombre="";
$apellido="";
$correo="";
$password ="";
$direccion="";
$telefono=0;

$sql="SELECT*FROM USER_INFO WHERE USER_ID = $id_usuario";
//echo $sql;
$runquery = oci_parse($con, $sql);                                  
$ok = oci_execute($runquery);


if($ok){
    while($row = oci_fetch_object($runquery)){
        do{
            $rut = $row->RUT;
            $nombre = $row->NOMBRES;
            $apellido = $row->APELLIDOS;
            $correo = $row->EMAIL;
            $password = $row->PASSWORD;
            $telefono = $row->TELEFONO;
            $direccion = $row->DIRECCION;

        }while($row = oci_fetch_object($runquery));
    }

}

?>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>

        <div class="row">
            <div class="col-md-2" style="text-aling:right; float:left; margin-left:50px;"><h5>Numero de Cliente: <?php echo "#$id_usuario"?></h5></div>
                <div class="col-md-6" id="perfil_cli_msg">
         
                </div>
            <div class="col-md-2" style="text-aling:right; float:right;"><h5><input type="checkbox" id="check" onchange="habilitar_campos_perfil_cliente(this.checked);" > Editar Perfil</h5></div>
            
		</div>
       
		<div class="row">
        
			<div class="container" style="width:50%;" class="col-md-8" >
					<div class="panel-heading"><h1>MI PERFIL</h1></div>
				<div class="panel-body" >

					<form method="POST">
						<div class="row">
						    <div class="col-md-12">
						        <label for="cli_rut">Rut</label>
						        <input type="text" id="cli_rut" name="cli_rut" class="form-control" disabled = 'true' >
						    </div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<label for="cli_nombre">Nombre</label>
								<input type="text" id="cli_nombre" name="cli_nombre" class="form-control"  VALUE = "<?php echo $nombre ;?>" disabled = 'true' >
							</div>
							<div class="col-md-6">
								<label for="cli_apellido">Apellidos</label>
								<input type="text" id="cli_apellido" name="cli_apellido" class="form-control" VALUE = "<?php echo $apellido;?>" disabled = 'true'>
							</div>
						</div>

						<div class="row">
							    <div class="col-md-6">                               
                                    <label for="cli_password">password</label>
                            <div class="row">
                                <div class="col-md-11">        
                                    <input type="password"   id="cli_password" name="cli_password" class="form-control"  VALUE = "<?php echo $_SESSION['pass'];?>" disabled = 'true'>
                                </div>   
                                <span><input type="checkbox" id="check_pass" onchange="mostrar_pass(this.checked);" disabled="true" ></span>
                                </div>
								
							</div>
						
					
							<div class="col-md-6">
								<label for="cli_telefono">Celular</label>
								<input type="text" id="cli_telefono" name="cli_telefono" class="form-control" VALUE = "<?php echo $telefono;?>" disabled = 'true'>
							</div>
						</div>

						<div class="row">
                            <div class="col-md-6">
								<label for="cli_correo">Email</label>
								<input type="text" id="cli_correo" name="cli_correo" class="form-control" VALUE = "<?php echo $correo;?>" disabled = 'true'>
							</div>
							<div class="col-md-6">
								<label for="cli_direccio">Dirección </label>
								<input type="text" id="cli_direccion" name="cli_direccio" class="form-control" VALUE = "<?php echo $direccion;?>" disabled = 'true'>
							</div>
						</div>
						
						<p><br></p>
						<div class="row">
							<div class="col-md-12">
                                <button type="button" user_id="" disabled = 'true' id="" name="actualizar_cliente" class="btn btn-primary">Actualizar</button>
							</div>
						</div>
						
					    </div>
					</form>					
				</div>			
    		</div>
	    </div>
        
    </body>
</html>

<script>
		
function habilitar_campos_perfil_cliente(value)
		{
			if(value==true)
			{
				// habilitamos
                document.getElementById("cli_rut").disabled=false;
                document.getElementById("cli_nombre").disabled=false;
                document.getElementById("cli_apellido").disabled=false;
                document.getElementById("cli_correo").disabled=false;
                document.getElementById("cli_password").disabled=false;
                document.getElementById("cli_telefono").disabled=false;
                document.getElementById("cli_direccion").disabled=false;
                document.getElementById("actualizar_cliente").disabled=false;
                document.getElementById("check_pass").disabled=false;
			}else if(value==false){
				// deshabilitamos
                document.getElementById("check_pass").disabled=true;
                document.getElementById("cli_rut").disabled=true;
                document.getElementById("cli_nombre").disabled=true;
                document.getElementById("cli_apellido").disabled=true;
                document.getElementById("cli_correo").disabled=true;
                document.getElementById("cli_password").disabled=true;
                document.getElementById("cli_telefono").disabled=true;
                document.getElementById("cli_direccion").disabled=true;
                document.getElementById("actualizar_cliente").disabled=true;
			}
        }
        

        function mostrar_pass(value)
		{
            if(value==true){
                document.getElementById("cli_password").type= "text";
            }else{
                document.getElementById("cli_password").type= password;
            }

        }
	</script>


















