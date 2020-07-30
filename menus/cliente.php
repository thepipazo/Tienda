<?php
session_start();
if(!isset($_SESSION["uid"]) or $_SESSION['tipo_user'] == 1 ){
	header("location:../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv=”Content-Type” content=”text/html;/>
    <meta charset="UTF-8">
    <title>Venta De Libros</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <script src="../js/jquery2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
                <span class="sr-only"> alternar navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                
                <span class="icon-bar"></span>
            </button>
            <a href="" class="navbar-brand">CoronaLibros</a>
        </div>
    <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav">
            <li><a href="../index.php"><span class="glyphicon glyphicon-modal-window"></span>Producto</a></li>
            <li style="width:300px;left:10px;top:10px;"><input type="text" class="form-control" id="search"></li>
            <li style="top:10px;left:20px;"><button class="btn btn-primary" id="search_btn">Buscar</button></li>
            
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="../Vista/mis_pedidos.php" class="dropdown-toggle"   class="glyphicon glyphicon-chevron-down"></span><?php echo "Mis Pedidos";?></a></li>

            <li><a href="#" id="cart_container" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Carro<span class="badge">0</span></a>
                <div class="dropdown-menu" style="width:400px;">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-3 col-xs-3">Sl.No</div>
                                <div class="col-md-3 col-xs-3">Imagen del producto</div>
                                <div class="col-md-3 col-xs-3">nombre del producto</div>
                                <div class="col-md-3 col-xs-3">Precio en $.</div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="cart_product">
                            <!--<div class="row">
                                <div class="col-md-3">Sl.No</div>
                                <div class="col-md-3">Product Image</div>
                                <div class="col-md-3">Product Name</div>
                                <div class="col-md-3">Price in $.</div>
                            </div>-->
                            </div>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </li>
            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo "Bienvenido,".$_SESSION["name"]; ?></a>
                <ul class="dropdown-menu">
                    <li><a href="cart.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-shopping-cart">Carro</a></li>
                    <li class="divider"></li>
                    <li><a href='enviarcorreo.php?hello=true' id="cambiar_password" name="cambiar_password"style="text-decoration:none; color:blue;">Cambia la contraseña</a></li>
                    <li class="divider"></li>
                    <li><a href="../controlador/logout.php" style="text-decoration:none; color:blue;">Cerrar sesión</a></li>
                
                </ul>
            </li>
            
        </ul>
    </div>
</div>
</div>