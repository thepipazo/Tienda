<?php
session_start();

if(isset($_SESSION["uid"]) and $_SESSION['tipo_user'] == 0){
	header("location:vista/perfil_usuario.php");
}elseif(isset($_SESSION["uid"]) and $_SESSION['tipo_user'] == 1 ){
	header("location:vista/perfil_admin.php");
}else
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
		<title>Venta De Libros</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
		<style>
			@media screen and (max-width:480px){
				#search{width:80%;}
				#search_btn{width:30%;float:right;margin-top:-32px;margin-right:10px;}
			}
		</style>
	</head>
<body>
<form  method="post">
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navegación</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="../ecomerce" class="navbar-brand">CoronaLibros</a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Producto</a></li>
				<li style="width:300px;left:10px;top:10px;"><input type="text" class="form-control" id="search"></li>
				<li style="top:10px;left:20px;"><button class="btn btn-primary" id="search_btn">Buscar</button></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Carro<span class="badge">0</span></a>
					<div class="dropdown-menu" style="width:400px;">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Imagen </div>
									<div class="col-md-3">nombre </div>
									<div class="col-md-3">Precio  $.</div>
								</div>
							</div>
							<div class="panel-body"></div>
							<div class="panel-footer"></div>
						</div>
					</div>
				</li>
				
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>iniciar sesion</a>
				<!--<li><a href="custom_login.php"><span class="glyphicon glyphicon-user"></span>Iniciar Sesion</a></li>-->
					<ul class="dropdown-menu">
						<div style="width:300px;">
							<div class="panel panel-primary">
								<div class="panel-heading">Iniciar sesión</div>
								<div class="panel-heading">
									<label for="email">Email</label>
									<input type="email" class="form-control" name="email" id="email" required/>
									<label for="email">Password</label>
									<input type="password" class="form-control" name="password" id="password" required/>
									<p><br/></p>
									<a href="#" style="color:white; list-style:none;"> Password Olvidado</a>
									<input type="button" class="btn btn-success" style="float:right;" id="logear" name="logear" value="Login">-->

								</div>
								<div class="panel-footer" id="e_msg"></div>
							</div>
						</div>
					</ul>
				</li>
				
				</form>
				<li><a href="custom_registro.php"><span class="glyphicon glyphicon-user"></span>Regístrate</a></li>
			</ul>
		</div>
	</div>
</div>	
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2 col-xs-12">
				<div id="get_category">
				</div>
				
				<div id="get_escritores">
				</div>
				
			</div>
			<div class="col-md-8 col-xs-12">
				<div class="row">
					<div class="col-md-12 col-xs-12" id="product_msg">
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">Productos</div>
					<div class="panel-body">
						<div id="get_product">
							
						</div>						
					</div>
					<div class="panel-footer">
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


</body>
</html>





