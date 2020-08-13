<?php
session_start();
if(!isset($_SESSION["uid"]) or $_SESSION['tipo_user'] == 0 ){
	header("location:../../index.php");
}?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Venta De Libros</title>
		<link rel="stylesheet" href="../../css/bootstrap.min.css"/>
		<script src="../../js/jquery2.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js " > </script> 
		<script src="../../js/main.js"></script>
		<link rel="icon" href="../../product_images/logo.png" type="image/png"/>
		<style>
			@media screen and (max-width:480px){
				#search{width:80%;}
				#search_btn{width:30%;float:right;margin-top:-32px;margin-right:10px;}
			}
		</style>
	</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<image type='image' src='../../product_images/esta_blanca.png'  style='border-radius:25px; width:50px; float:left; height:50px;'></image>
				<a href="" class="navbar-brand"> &nbsp CoronaLibros</a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
				
				<li><a href="../../index.php"><span class="glyphicon glyphicon-modal-window"></span> Producto</a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-chevron-down"></span><?php echo " Nuevo";?></a>
					<ul class="dropdown-menu">
						<li><a href="nuevo_libro.php" class="glyphicon glyphicon-book" id="nuevo_libro" name="nuevo_libro"style="text-decoration:none; color:blue;"> Libro</a></li>
						<li class="divider"></li>
						<li><a href="nuevo_categoria.php" class="glyphicon glyphicon-th-large" id="nuevo_categoria" name="nuevo_categoria"style="text-decoration:none; color:blue;"> Categori</a></li>
						<li class="divider"></li>
						<li><a href="nuevo_tipo.php" class="glyphicon glyphicon-star-empty" id="nuevo_escritor" name="nuevo_escritor"style="text-decoration:none; color:blue;"> Tipo</a></li>
						<li class="divider"></li>
						<li><a href="nuevo_autor.php" class="glyphicon glyphicon-user" id="nuevo_autor" name="nuevo_autor"style="text-decoration:none; color:blue;"> Autor</a></li>
						<li class="divider"></li>
						<li><a href="nuevo_editorial.php" class="glyphicon glyphicon-text-size" id="nuevo_editorial" name="nuevo_editorial"style="text-decoration:none; color:blue;"> Editorial</a></li>
						
					</ul>
				</li>
				<li><a href="habilitar.php"><span class="glyphicon glyphicon-ban-circle"></span> Habilitar</a></li>
				<li><a href="ofertar.php"> <span class="glyphicon glyphicon-tag"></span> Ofertas </a></li>

			</ul>



		
			<ul class="nav navbar-nav navbar-right">
				
				
				</li>
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo " Bienvenido,".$_SESSION["name"]; ?></a>
					<ul class="dropdown-menu">
						<li><a href="enviarcorreo.php" id="cambiar_password" name="cambiar_password"style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-lock"></span> Cambia la contraseña</a></li>
						<li class="divider"></li>
						<li><a href="../../controlador/logout.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
					</ul>
				</li>
				
			</ul>
		</div>
	</div>
	</div>