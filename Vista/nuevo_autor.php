

<?php
include "../menus/admin.php";
?>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="aut_msg">
				
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Formulario de registro de Autor</div>
					<div class="panel-body">
					
					<form method="post">
						<div class="row">
						
							<div class="col-md-12">
								<label for="nombre_autor">Nombre Del Autor</label>
								<input type="text" id="nombre_autor" name="nombre_autor" class="form-control">
							</div>
							<div class="col-md-12">
								<label for="reseña_autor">Reseña</label>
								<textarea class="form-control" id="reseña_autor" name="reseña_autor" rows="5" ></textarea>
							</div>
						</div>
						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
							<input style="" value="Ingresar" type="button" id="ingreso_autor" name="ingreso_autor"  class="btn btn-success btn-lg">
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



















