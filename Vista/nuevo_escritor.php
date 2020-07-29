

<?php
include "../menus/admin.html";
?>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="escrit_msg">
				
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Formulario de registro de Escritores</div>
					<div class="panel-body">
					
					<form method="post">
						<div class="row">
						
						<div class="col-md-12">
								<label for="nombre_tipo">Nombre Del "TIPO"</label>
								<input type="text" id="nombre_tipo" name="nombre_tipo" class="form-control">
							</div>
							<div class="col-md-12">
								<label for="descripcion_tipo">Descripcion</label>
								<textarea class="form-control" id="descripcion_tipo" name="descripcion_tipo" rows="5" ></textarea>
							</div>
						</div>
						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
							<input style="" value="Registrar" type="button" id="ingresotipo" name="ingresotipo"  class="btn btn-success btn-lg">
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
