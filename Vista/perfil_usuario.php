<?php

session_start();
if(!isset($_SESSION["uid"]) or $_SESSION['tipo_user'] == 1 ){
	header("location:index.php");
}
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
			<div class="col-md-1"></div>
			<div class="col-md-2">
				<div id="get_category">
					<!--aqui vienen las categorias desde mein js -->
				</div>
				  
				<div id="get_brand">
				</div>
				
					<!--aqui vienen los escritores desde mein js -->

			</div>
			<div class="col-md-8">	
				<div class="row">
					<div class="col-md-12 col-xs-12" id="product_msg">
					</div>
				</div>
				<div class="panel panel-info" id="scroll">
					<div class="panel-heading">Productos</div>
					<div class="panel-body">
						<div id="get_product">
							<!--aqui vienen los Libros desde mein js -->
						</div>
						 

					</div>
					<div class="panel-footer">

					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<center>
					<ul class="pagination" id="pageno">
						<li><a href="#">1</a></li>
					</ul>
				</center>
			</div>
		</div>
	</div>
</body>
</html>
















































