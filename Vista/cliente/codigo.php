<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
		<title>Libros</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
	</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<a href="" class="navbar-brand">Libros</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Inicio</a></li>
				<li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Producto</a></li>
			</ul>
		</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="codigo_msg">
				<!--Alert from signup form-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
<?php
			
			?>
				<div class="panel panel-primary">
					<div class="panel-heading">Te Enviamos Un Correo Para Que Puedas Restablecer Tu Contraseña</div>
					<div class="panel-body">
					
					<form method="POST">
						
					
						<div class="row">
							<div class="col-md-12">
								<label for="codigo">Codigo</label>
								<input type="number" id="code" name="code" class="form-control">
							</div>
						</div>
						
						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
							<input style="" value="verificar" type="button" id="verificar" name="verificar"  class="btn btn-success btn-lg">
								<a href="" action="" id="reenviar " name="reenviar" style="float:right;">Enviar Correo Nuevamente</a>
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




