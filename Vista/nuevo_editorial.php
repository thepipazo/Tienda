
<?php
include "../menus/admin.html";
?>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="edit_msg">
				
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Formulario de registro de Editorial</div>
					<div class="panel-body">
					
					<form method="post">
						<div class="row">
						
							<div class="col-md-12">
								<label for="nombre_editorial">Nombre De La Editorial</label>
								<input type="text" id="nombre_editorial" name="nombre_editorial" class="form-control">
							</div>
							<div class="col-md-12">
								<label for="descripcionedit">Descripcion</label>
								<textarea class="form-control" id="descripcionedit" name="descripcionedit" rows="5" ></textarea>
							</div>
						</div>
						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
							<input style="" value="Ingresar" type="button" id="ingreso_edit" name="ingreso_edit"  class="btn btn-success btn-lg">
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



















