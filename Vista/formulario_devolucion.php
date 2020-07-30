<?php
include "../db.php";
$id_usuario=$_SESSION["uid"];
$id_detalle=$_GET['iddetalle'];
$id_libro = $_GET['idlibro'];
$id_venta = $_GET['idventa'];
$sql="SELECT NOMBRES,EMAIL FROM USER_INFO WHERE USER_ID=$id_usuario";
//echo $sql;
$runquery = oci_parse($con, $sql);                                  
$ok = oci_execute($runquery);
$row = oci_fetch_assoc($runquery);
oci_free_statement($runquery);

?>

<!DOCTYPE html>
<html>
<?php
include "../menus/cliente.html";
?>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="devolver_msg">
				<!--Alert from signup form-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Formulario de devolucion</div>
					<div class="panel-body">
					
					<form method="post" >
						<div class="row">
							<div class="col-md-6">
								<label for="f_name">Nombre</label>
								<input type="text" id="f_name" name="f_name" value="<?php echo $row['NOMBRES']?>" readonly  class="form-control">
							</div>
							<div class="col-md-6">
								<label for="f_name">Email</label>
								<input type="text" id="email" value="<?php echo $row['EMAIL']?>" name="email"  readonly class="form-control">
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-3">
								<label for="f_name">ID de Pedido</label>
								<input type="text" id="nventa" value="<?php echo $id_detalle?>" name="nventa" readonly class="form-control">
							</div>
							
							<div class="col-md-6">
								<label for="f_name">ID LIBRO</label>
								<input type="text" id="nlibro" value="<?php echo $id_libro?>" name="nlibro" readonly class="form-control">
							</div>
							<div class="col-md-3">
								<label for="f_name">ID Venta</label>
								<input type="text" id="nventa2" value="<?php echo $id_venta?>" name="nventa2" readonly class="form-control">
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<label>Por que quieres devolver este producto? marca una sola opcion</label>
							</div>
						</div>
						<div class="form-group">
  <div class="">
  <div class="radio">
    <label for="radios">
      <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
      no cumplió mis expectativas
    </label>
	</div>
  <div class="radio">
    <label for="radios-1">
      <input type="radio" name="radios" id="radios-1" value="2">
      no me gusto
    </label>
	</div>
  <div class="radio">
    <label for="radios-2">
      <input type="radio" name="radios" id="radios-2" value="3">
      cambie de opinión
    </label>
	</div>
  <div class="radio">
    <label for="radios-3">
      <input type="radio" name="radios" id="radios-3" value="4">
      presenta fallas de calidad
    </label>
	</div>
  <div class="radio">
    <label for="radios-4">
      <input type="radio" name="radios" id="radios-4" value="5">
      otro
    </label>
	</div>
  </div>
</div>
						<div class="row">
							<div class="col-md-6">
								<label for="f_name">Otro. por favor especifique</label>
								<input type="text" id="otro" name="otro" disabled="disabled" class="form-control">
							</div>
							</div>
						<p><br/></p>
						<div class="row">
							<div class="col-md-7">
							<input style="float:right;" value="devolver" type="button" id="devolver" name="devolver"  class="btn btn-success btn-lg">
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
<script type="text/javascript">
    $(function () {
        $("input[name='radios']").click(function () {
            if ($("#radios-4").is(":checked")) {
                $("#otro").removeAttr("disabled");
                $("#otro").focus();
            } else {
                $("#otro").attr("disabled", "disabled");
            }
        });
    });
</script>

















