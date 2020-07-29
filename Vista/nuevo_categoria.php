

<?php
include "../menus/admin.html";
?>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="cat_msg">
				
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Formulario de registro de categoria</div>
					<div class="panel-body">
					
					<form method="post">
						<div class="row">
						
							<div class="col-md-12">
								<label for="catnombre">Nombre De La Categoria</label>
								<input type="text" id="catnombre" name="catnombre" class="form-control">
							</div>
						</div>
						<div class="row">	
							<div class="col-md-12">
								<label for="catdescripcion">Descripcion</label>
								<textarea type="text" id="catdescripcion" name="catdescripcion" class="form-control"></textarea>
							</div>
						</div>
						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
							<input style="" value="verificar" type="button" id="ingresocat" name="ingresocat"  class="btn btn-success btn-lg">
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



















